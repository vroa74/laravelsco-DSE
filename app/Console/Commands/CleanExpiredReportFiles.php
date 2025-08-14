<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportFile;
use Illuminate\Support\Facades\Storage;

class CleanExpiredReportFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:clean-expired {--force : Forzar limpieza sin confirmación}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar archivos de reportes expirados y archivos físicos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando archivos de reportes expirados...');

        // Obtener archivos expirados
        $expiredFiles = ReportFile::expired()->get();
        
        if ($expiredFiles->isEmpty()) {
            $this->info('No se encontraron archivos expirados.');
            return 0;
        }

        $this->warn("Se encontraron {$expiredFiles->count()} archivos expirados.");

        if (!$this->option('force')) {
            if (!$this->confirm('¿Deseas eliminar estos archivos?')) {
                $this->info('Operación cancelada.');
                return 0;
            }
        }

        $deletedCount = 0;
        $errorCount = 0;

        foreach ($expiredFiles as $file) {
            try {
                if ($file->deleteFile()) {
                    $deletedCount++;
                    $this->line("✓ Eliminado: {$file->original_name}");
                } else {
                    $errorCount++;
                    $this->error("✗ Error al eliminar: {$file->original_name}");
                }
            } catch (\Exception $e) {
                $errorCount++;
                $this->error("✗ Excepción al eliminar {$file->original_name}: {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Limpieza completada:");
        $this->info("- Archivos eliminados: {$deletedCount}");
        $this->info("- Errores: {$errorCount}");

        return 0;
    }
} 