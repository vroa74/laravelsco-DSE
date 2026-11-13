<?php

namespace App\Http\Controllers;

use App\Models\Co;  // import dompdf
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportsController extends Controller
{
    public function rg_report_1($id, $tipoReporte)
    {
        $registro = Co::visibleTo(auth()->user())->findOrFail($id);
        $filename = 'file_'.$registro->id.'_'.$registro->ncor.'pdf';
        $pdf = PDF::loadView('reports.reportn', compact('registro', 'tipoReporte'));

        return $pdf->stream($filename);
    }

    public function rg_report_2($id, $tipoReporte)
    {
        $registro = Co::visibleTo(auth()->user())->findOrFail($id);
        $filename = 'file_'.$registro->id.'_'.$registro->ncor.'pdf';
        $pdf = PDF::loadView('reports.reporte', compact('registro', 'tipoReporte'));

        return $pdf->stream($filename);

    }

    public function rg_report_3($id, $tipoReporte)
    {
        $registro = Co::visibleTo(auth()->user())->findOrFail($id);
        $filename = 'file_'.$registro->id.'_'.$registro->ncor.'pdf';
        $pdf = PDF::loadView('reports.reports', compact('registro', 'tipoReporte'));

        return $pdf->stream($filename);

    }

    public function user_report() {}
}
