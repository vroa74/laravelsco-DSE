<?php

namespace App\Http\Controllers;

use App\Models\ReportFile;
use App\Models\Co;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ReportFileController extends Controller
{
    /**
     * Subir archivo PDF para un reporte
     */
    public function upload(Request $request, $reportId)
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // 10MB máximo
            'report_type' => 'required|string|in:co,age,leg'
        ]);

        try {
            $reportFile = ReportFile::createFromUpload(
                $reportId,
                $request->report_type,
                $request->file('pdf_file')
            );

            return response()->json([
                'success' => true,
                'message' => 'Archivo subido correctamente',
                'file' => [
                    'id' => $reportFile->id,
                    'name' => $reportFile->original_name,
                    'size' => $reportFile->getFormattedFileSize(),
                    'expires_at' => $reportFile->expires_at->format('Y-m-d H:i:s'),
                    'downloads_remaining' => $reportFile->max_downloads - $reportFile->download_count
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir archivo: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Descargar archivo PDF
     */
    public function download($fileId)
    {
        $reportFile = ReportFile::findOrFail($fileId);

        // Verificar si puede ser descargado
        if (!$reportFile->canBeDownloaded()) {
            if ($reportFile->isExpired()) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo ha expirado'
                ], 410);
            }

            if ($reportFile->hasReachedDownloadLimit()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Se ha alcanzado el límite de descargas'
                ], 429);
            }

            return response()->json([
                'success' => false,
                'message' => 'El archivo no está disponible'
            ], 404);
        }

        // Verificar que el archivo físico existe
        if (!Storage::disk('public')->exists($reportFile->file_path)) {
            return response()->json([
                'success' => false,
                'message' => 'El archivo no se encuentra en el servidor'
            ], 404);
        }

        // Incrementar contador de descargas
        $reportFile->incrementDownloadCount();

        // Descargar archivo
        return Storage::disk('public')->download(
            $reportFile->file_path,
            $reportFile->original_name,
            [
                'Content-Type' => $reportFile->mime_type,
                'Content-Disposition' => 'attachment; filename="' . $reportFile->original_name . '"'
            ]
        );
    }

    /**
     * Listar archivos de un reporte
     */
    public function list($reportId, $reportType)
    {
        $files = ReportFile::where('report_id', $reportId)
                          ->where('report_type', $reportType)
                          ->orderBy('created_at', 'desc')
                          ->get()
                          ->map(function ($file) {
                              return [
                                  'id' => $file->id,
                                  'name' => $file->original_name,
                                  'size' => $file->getFormattedFileSize(),
                                  'downloads_remaining' => $file->max_downloads - $file->download_count,
                                  'expires_at' => $file->expires_at->format('Y-m-d H:i:s'),
                                  'days_until_expiration' => $file->getDaysUntilExpiration(),
                                  'can_download' => $file->canBeDownloaded()
                              ];
                          });

        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }

    /**
     * Eliminar archivo
     */
    public function delete($fileId)
    {
        $reportFile = ReportFile::findOrFail($fileId);

        if ($reportFile->deleteFile()) {
            return response()->json([
                'success' => true,
                'message' => 'Archivo eliminado correctamente'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar archivo'
        ], 500);
    }

    /**
     * Obtener estadísticas de archivos
     */
    public function stats()
    {
        $stats = [
            'total_files' => ReportFile::count(),
            'expired_files' => ReportFile::expired()->count(),
            'downloadable_files' => ReportFile::downloadable()->count(),
            'total_size' => ReportFile::sum('file_size'),
            'total_downloads' => ReportFile::sum('download_count')
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }
} 