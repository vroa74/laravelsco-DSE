<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;  // import dompdf
use App\Models\Co;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;


class ReportsController extends Controller
{
    public function rg_report_1($id, $tipoReporte){
         $registro = Co::find($id);
         $filename = "file_".$registro->id."_".$registro->ncor."pdf";
        $pdf = Pdf::loadView('reports.reportn', compact('registro', 'tipoReporte'));
        return $pdf->stream($filename);
    }

    public function rg_report_2($id, $tipoReporte){
        $registro = Co::find($id);
        $filename = "file_".$registro->id."_".$registro->ncor."pdf";
        $pdf = Pdf::loadView('reports.reporte', compact('registro', 'tipoReporte'));
        return $pdf->stream($filename);

    }

    public function rg_report_3($id, $tipoReporte){
        $registro = Co::find($id);
        $filename = "file_".$registro->id."_".$registro->ncor."pdf";
        $pdf = Pdf::loadView('reports.reports', compact('registro', 'tipoReporte'));
        return $pdf->stream($filename);

    }

    public function user_report(){

    }

}
