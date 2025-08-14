<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ReportFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'report_type',
        'original_name',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'download_count',
        'max_downloads',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'file_size' => 'integer',
        'download_count' => 'integer',
        'max_downloads' => 'integer'
    ];

    /**
     * Verificar si el archivo puede ser descargado
     */
    public function canBeDownloaded(): bool
    {
        return $this->download_count < $this->max_downloads && 
               $this->expires_at->isFuture() &&
               Storage::disk('public')->exists($this->file_path);
    }

    /**
     * Incrementar contador de descargas
     */
    public function incrementDownloadCount(): bool
    {
        if (!$this->canBeDownloaded()) {
            return false;
        }

        $this->increment('download_count');
        return true;
    }

    /**
     * Verificar si el archivo ha expirado
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Verificar si se ha alcanzado el límite de descargas
     */
    public function hasReachedDownloadLimit(): bool
    {
        return $this->download_count >= $this->max_downloads;
    }

    /**
     * Obtener el tamaño del archivo en formato legible
     */
    public function getFormattedFileSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Obtener días restantes hasta expiración
     */
    public function getDaysUntilExpiration(): int
    {
        return max(0, Carbon::now()->diffInDays($this->expires_at, false));
    }

    /**
     * Crear un nuevo archivo de reporte
     */
    public static function createFromUpload($reportId, $reportType, $uploadedFile): self
    {
        // Validar tamaño máximo (10MB = 10 * 1024 * 1024 bytes)
        $maxSize = 10 * 1024 * 1024;
        if ($uploadedFile->getSize() > $maxSize) {
            throw new \Exception('El archivo excede el tamaño máximo de 10MB');
        }

        // Generar nombre único para el archivo
        $fileName = uniqid('report_') . '_' . time() . '.pdf';
        $filePath = 'report-files/' . $fileName;

        // Guardar archivo en storage
        Storage::disk('public')->put($filePath, file_get_contents($uploadedFile));

        // Crear registro en base de datos
        return self::create([
            'report_id' => $reportId,
            'report_type' => $reportType,
            'original_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $filePath,
            'file_name' => $fileName,
            'mime_type' => $uploadedFile->getMimeType(),
            'file_size' => $uploadedFile->getSize(),
            'download_count' => 0,
            'max_downloads' => 5,
            'expires_at' => Carbon::now()->addDays(7) // 7 días naturales
        ]);
    }

    /**
     * Eliminar archivo físico y registro
     */
    public function deleteFile(): bool
    {
        // Eliminar archivo físico
        if (Storage::disk('public')->exists($this->file_path)) {
            Storage::disk('public')->delete($this->file_path);
        }

        // Eliminar registro
        return $this->delete();
    }

    /**
     * Scope para archivos expirados
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', Carbon::now());
    }

    /**
     * Scope para archivos que pueden ser descargados
     */
    public function scopeDownloadable($query)
    {
        return $query->where('download_count', '<', 'max_downloads')
                    ->where('expires_at', '>', Carbon::now());
    }

    /**
     * Relación con el modelo Co (ajustar según tus necesidades)
     */
    public function report()
    {
        return $this->belongsTo(Co::class, 'report_id');
    }
} 