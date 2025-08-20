<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CosFile extends Model
{
    protected $fillable = [
        'cos_id',
        'original_name',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
        'uploaded_by'
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Relación con el registro CO
     */
    public function cos()
    {
        return $this->belongsTo(Co::class, 'cos_id');
    }

    /**
     * Obtener la URL del archivo
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    /**
     * Obtener el tamaño del archivo en formato legible
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Verificar si el archivo existe en el almacenamiento
     */
    public function exists()
    {
        return Storage::exists($this->file_path);
    }

    /**
     * Eliminar el archivo físico del almacenamiento
     */
    public function deleteFile()
    {
        if ($this->exists()) {
            Storage::delete($this->file_path);
        }
    }

    /**
     * Scope para archivos PDF
     */
    public function scopePdf($query)
    {
        return $query->where('file_type', 'pdf');
    }

    /**
     * Scope para archivos por tamaño máximo (15MB)
     */
    public function scopeMaxSize($query, $maxSize = 15728640) // 15MB en bytes
    {
        return $query->where('file_size', '<=', $maxSize);
    }
}
