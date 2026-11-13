<?php

namespace App\Actions\Correspondence;

use App\Models\Co;
use App\Models\CosFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadCorrespondenceFile
{
    /** Autoriza documento/archivo antes de resolver una ruta de almacenamiento. */
    public function __invoke(string $documento, string $archivo): StreamedResponse
    {
        $co = Co::visibleTo(auth()->user())->findOrFail($documento);
        $file = CosFile::where('cos_id', $co->id)->findOrFail($archivo);
        abort_unless(is_string($file->file_path) && preg_match('~^cos-files/[A-Za-z0-9._-]+\.pdf$~', $file->file_path), 404);
        abort_unless(Storage::disk('public')->exists($file->file_path), 404);
        $filename = preg_replace('~[\\\\/\x00-\x1F\x7F]~', '_', $file->original_name);

        return Storage::disk('public')->download($file->file_path, $filename ?: 'adjunto.pdf', ['X-Content-Type-Options' => 'nosniff']);
    }
}
