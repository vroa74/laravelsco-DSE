<?php

namespace App\Http\Controllers;

use App\Actions\Correspondence\DownloadCorrespondenceFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CorrespondenceFileController extends Controller
{
    public function __invoke(string $documento, string $archivo): StreamedResponse
    {
        return app(DownloadCorrespondenceFile::class)($documento, $archivo);
    }
}
