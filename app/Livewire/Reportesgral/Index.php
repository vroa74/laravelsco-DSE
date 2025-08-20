<?php

namespace App\Livewire\Reportesgral;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;  //pdf
use Illuminate\Support\Facades\Response;  //pdf
use Barryvdh\DomPDF\Facade\Pdf;  // import dompdf
use App\Models\Co;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;
use App\Models\UserGroup;

class Index extends Component
{
    use WithPagination;

    public $NumPag = 10;
    public $folioinit, $foliofin;
    public $des, $seg;
    public $fcapini, $fcapfin;
    public $frecini, $frecfin;
    public $fofiini, $fofifin;
    public $turnom, $turcargo, $turdeporg;
    public $remnombre, $remcargo, $remdeporg;
    public $Nccors, $Tccors, $Cccors;
    public $ncor_filter; // Add filter for N. Cor.
    public $tcor_filter; // Add filter for T. Cor.
    public $ccor_filter; // Add filter for Clas. Cor.
    
    // Nuevas propiedades para el sistema de turnado
    public $turnadoTypeFilter = '';
    public $turnadoUserIdFilter = null;
    public $turnadoGroupIdFilter = null;
    public $userGroups; // Para los filtros de grupos
    
    //    begin     open modal
    public $isOpen = true;

    //    end     open modal

    public function toggleAccordion()
    {
        $this->isOpen = !$this->isOpen; // Alterna entre abierto y cerrado
    }

    public function getFilteredCount()
    {
        // Get the filtered data count without pagination
        $query = Co::query();
        
        // Apply ALL filters exactly like in the render method
        // Filtro para 'id' basado en folioinit y foliofin
        if (
            (!is_null($this->folioinit) && $this->folioinit != 0) && ($this->folioinit != '') &&
            (is_null($this->foliofin) || $this->foliofin == 0)
        ) {
            $query->where('id', '=', $this->folioinit);
        } elseif (
            (!is_null($this->foliofin) && $this->foliofin != 0) && ($this->foliofin != '') &&
            (is_null($this->folioinit) || $this->folioinit == 0)
        ) {
            $query->where('id', '=', $this->foliofin);
        } elseif (
            (!is_null($this->folioinit) && $this->folioinit != 0) &&
            (!is_null($this->foliofin) && $this->foliofin != 0) &&
            $this->folioinit != $this->foliofin
        ) {
            $query->whereBetween('id', [
                min($this->folioinit, $this->foliofin),
                max($this->folioinit, $this->foliofin)
            ]);
        } elseif (
            (!is_null($this->folioinit) && $this->folioinit != 0) &&
            (!is_null($this->foliofin) && $this->foliofin != 0) &&
            $this->folioinit == $this->foliofin
        ) {
            $query->where('id', '=', $this->folioinit);
        }

        // Filtro por 'fcap' basado en fechas fcapini y fcapfin
        if (!is_null($this->fcapini) && is_null($this->fcapfin)) {
            $query->whereDate('fcap', '=', $this->fcapini);
        } elseif (is_null($this->fcapini) && !is_null($this->fcapfin)) {
            $query->whereDate('fcap', '=', $this->fcapfin);
        } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini == $this->fcapfin) {
            $query->whereDate('fcap', '=', $this->fcapini);
        } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini != $this->fcapfin) {
            $query->whereBetween('fcap', [
                min($this->fcapini, $this->fcapfin),
                max($this->fcapini, $this->fcapfin)
            ]);
        }

        // Filtro por 'frec' basado en fechas frecini y frecfin
        if (!is_null($this->frecini) && is_null($this->frecfin)) {
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (is_null($this->frecini) && !is_null($this->frecfin)) {
            $query->whereDate('frec', '=', $this->frecfin);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini == $this->frecfin) {
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini != $this->frecfin) {
            $query->whereBetween('frec', [
                min($this->frecini, $this->frecfin),
                max($this->frecini, $this->frecfin)
            ]);
        }

        // Filtro por 'fofi' basado en fechas fofiini y fofifin
        if (!is_null($this->fofiini) && is_null($this->fofifin)) {
            $query->whereDate('fofi', '=', $this->fofiini);
        } elseif (is_null($this->fofiini) && !is_null($this->fofifin)) {
            $query->whereDate('fofi', '=', $this->fofifin);
        } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini == $this->fofifin) {
            $query->whereDate('fofi', '=', $this->fofiini);
        } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini != $this->fofifin) {
            $query->whereBetween('fofi', [
                min($this->fofiini, $this->fofifin),
                max($this->fofiini, $this->fofifin)
            ]);
        }

        // Filtros de texto
        if (!is_null($this->des) && $this->des !== '') {
            $query->where('des', 'like', '%' . $this->des . '%');
        }
        if (!is_null($this->seg) && $this->seg !== '') {
            $query->where('seguimiento', 'like', '%' . $this->seg . '%');
        }

        // Filtros de remitente
        if (!is_null($this->remnombre) && $this->remnombre !== '') {
            $query->where('rem_nombre', 'like', '%' . $this->remnombre . '%');
        }
        if (!is_null($this->remcargo) && $this->remcargo !== '') {
            $query->where('rem_cargo', 'like', '%' . $this->remcargo . '%');
        }
        if (!is_null($this->remdeporg) && $this->remdeporg !== '') {
            $query->where('rem_deporg', 'like', '%' . $this->remdeporg . '%');
        }

        // Filtros de turnado
        if (!is_null($this->turnom) && $this->turnom !== '') {
            $query->where('tur_nom', 'like', '%' . $this->turnom . '%');
        }
        if (!is_null($this->turcargo) && $this->turcargo !== '') {
            $query->where('tur_cargo', 'like', '%' . $this->turcargo . '%');
        }
        if (!is_null($this->turdeporg) && $this->turdeporg !== '') {
            $query->where('tur_deporg', 'like', '%' . $this->turdeporg . '%');
        }

        // Filtro por 'ncor' (N. Cor.)
        if (!is_null($this->ncor_filter) && $this->ncor_filter !== '' && $this->ncor_filter !== 'Seleccione una opción') {
            // Obtener el valor ncor de la tabla ncors basado en el ID seleccionado
            $ncorValue = Ncor::find($this->ncor_filter);
            if ($ncorValue) {
                $query->where('ncor', '=', $ncorValue->ncor);
            }
        }

        // Filtro por 'tcor' (T. Cor.)
        if (!is_null($this->tcor_filter) && $this->tcor_filter !== '' && $this->tcor_filter !== 'Seleccione una opción') {
            // Obtener el valor tcor de la tabla tcors basado en el ID seleccionado
            $tcorValue = Tcor::find($this->tcor_filter);
            if ($tcorValue) {
                $query->where('tcor', '=', $tcorValue->tcor);
            }
        }

        // Filtro por 'ccor' (Clas. Cor.)
        if (!is_null($this->ccor_filter) && $this->ccor_filter !== '' && $this->ccor_filter !== 'Seleccione una opción') {
            // Obtener el valor ccor de la tabla ccors basado en el ID seleccionado
            $ccorValue = Ccor::find($this->ccor_filter);
            if ($ccorValue) {
                $query->where('ccor', '=', $ccorValue->ccor);
            }
        }

        return $query->count();
    }

    public function exportPDF()
    {
        try {
            // Get the filtered data with optimizations
            $query = Co::query();
            
            // Apply ALL filters exactly like in the render method
            // Filtro para 'id' basado en folioinit y foliofin
            if (
                (!is_null($this->folioinit) && $this->folioinit != 0) && ($this->folioinit != '') &&
                (is_null($this->foliofin) || $this->foliofin == 0)
            ) {
                $query->where('id', '=', $this->folioinit);
            } elseif (
                (!is_null($this->foliofin) && $this->foliofin != 0) && ($this->foliofin != '') &&
                (is_null($this->folioinit) || $this->folioinit == 0)
            ) {
                $query->where('id', '=', $this->foliofin);
            } elseif (
                (!is_null($this->folioinit) && $this->folioinit != 0) &&
                (!is_null($this->foliofin) && $this->foliofin != 0) &&
                $this->folioinit != $this->foliofin
            ) {
                $query->whereBetween('id', [
                    min($this->folioinit, $this->foliofin),
                    max($this->folioinit, $this->foliofin)
                ]);
            } elseif (
                (!is_null($this->folioinit) && $this->folioinit != 0) &&
                (!is_null($this->foliofin) && $this->foliofin != 0) &&
                $this->folioinit == $this->foliofin
            ) {
                $query->where('id', '=', $this->folioinit);
            }

            // Filtro por 'fcap' basado en fechas fcapini y fcapfin
            if (!is_null($this->fcapini) && is_null($this->fcapfin)) {
                $query->whereDate('fcap', '=', $this->fcapini);
            } elseif (is_null($this->fcapini) && !is_null($this->fcapfin)) {
                $query->whereDate('fcap', '=', $this->fcapfin);
            } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini == $this->fcapfin) {
                $query->whereDate('fcap', '=', $this->fcapini);
            } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini != $this->fcapfin) {
                $query->whereBetween('fcap', [
                    min($this->fcapini, $this->fcapfin),
                    max($this->fcapini, $this->fcapfin)
                ]);
            }

            // Filtro por 'frec' basado en fechas frecini y frecfin
            if (!is_null($this->frecini) && is_null($this->frecfin)) {
                $query->whereDate('frec', '=', $this->frecini);
            } elseif (is_null($this->frecini) && !is_null($this->frecfin)) {
                $query->whereDate('frec', '=', $this->frecfin);
            } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini == $this->frecfin) {
                $query->whereDate('frec', '=', $this->frecini);
            } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini != $this->frecfin) {
                $query->whereBetween('frec', [
                    min($this->frecini, $this->frecfin),
                    max($this->frecini, $this->frecfin)
                ]);
            }

            // Filtro por 'fofi' basado en fechas fofiini y fofifin
            if (!is_null($this->fofiini) && is_null($this->fofifin)) {
                $query->whereDate('fofi', '=', $this->fofiini);
            } elseif (is_null($this->fofiini) && !is_null($this->fofifin)) {
                $query->whereDate('fofi', '=', $this->fofifin);
            } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini == $this->fofifin) {
                $query->whereDate('fofi', '=', $this->fofiini);
            } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini != $this->fofifin) {
                $query->whereBetween('fofi', [
                    min($this->fofiini, $this->fofifin),
                    max($this->fofiini, $this->fofifin)
                ]);
            }

            // Filtros de texto
            if (!is_null($this->des) && $this->des !== '') {
                $query->where('des', 'like', '%' . $this->des . '%');
            }
            if (!is_null($this->seg) && $this->seg !== '') {
                $query->where('seguimiento', 'like', '%' . $this->seg . '%');
            }

            // Filtros de remitente
            if (!is_null($this->remnombre) && $this->remnombre !== '') {
                $query->where('rem_nombre', 'like', '%' . $this->remnombre . '%');
            }
            if (!is_null($this->remcargo) && $this->remcargo !== '') {
                $query->where('rem_cargo', 'like', '%' . $this->remcargo . '%');
            }
            if (!is_null($this->remdeporg) && $this->remdeporg !== '') {
                $query->where('rem_deporg', 'like', '%' . $this->remdeporg . '%');
            }

            // Filtros de turnado
            if (!is_null($this->turnom) && $this->turnom !== '') {
                $query->where('tur_nom', 'like', '%' . $this->turnom . '%');
            }
            if (!is_null($this->turcargo) && $this->turcargo !== '') {
                $query->where('tur_cargo', 'like', '%' . $this->turcargo . '%');
            }
            if (!is_null($this->turdeporg) && $this->turdeporg !== '') {
                $query->where('tur_deporg', 'like', '%' . $this->turdeporg . '%');
            }

            // Filtro por 'ncor' (N. Cor.)
            if (!is_null($this->ncor_filter) && $this->ncor_filter !== '' && $this->ncor_filter !== 'Seleccione una opción') {
                // Obtener el valor ncor de la tabla ncors basado en el ID seleccionado
                $ncorValue = Ncor::find($this->ncor_filter);
                if ($ncorValue) {
                    $query->where('ncor', '=', $ncorValue->ncor);
                }
            }

            // Filtro por 'tcor' (T. Cor.)
            if (!is_null($this->tcor_filter) && $this->tcor_filter !== '' && $this->tcor_filter !== 'Seleccione una opción') {
                // Obtener el valor tcor de la tabla tcors basado en el ID seleccionado
                $tcorValue = Tcor::find($this->tcor_filter);
                if ($tcorValue) {
                    $query->where('tcor', '=', $tcorValue->tcor);
                }
            }

            // Filtro por 'ccor' (Clas. Cor.)
            if (!is_null($this->ccor_filter) && $this->ccor_filter !== '' && $this->ccor_filter !== 'Seleccione una opción') {
                // Obtener el valor ccor de la tabla ccors basado en el ID seleccionado
                $ccorValue = Ccor::find($this->ccor_filter);
                if ($ccorValue) {
                    $query->where('ccor', '=', $ccorValue->ccor);
                }
            }

            // Get records with limit
            $registros = $query->select([
                'id', 'legislatura', 'fcap', 'rem_nombre', 'rem_cargo', 
                'rem_deporg', 'des', 'seguimiento'
            ])
            ->orderBy('id', 'desc')
            ->limit(2000)
            ->get();

            // Check if too many records
            if ($registros->count() >= 2000) {
                $this->dispatch('reporteError', 'Demasiados registros para exportar (máximo 2000). Aplica más filtros para reducir los resultados.');
                return;
            }

            if ($registros->count() == 0) {
                $this->dispatch('reporteError', 'No se encontraron registros con los filtros aplicados.');
                return;
            }

            // Generate PDF
            $pdf = Pdf::loadView('reports.reporte', ['registros' => $registros]);
            $pdf->setPaper('a4', 'portrait');
            
            // Dispatch success event
            $this->dispatch('reporteGenerado', 'PDF generado correctamente con ' . $registros->count() . ' registros.');
            
            // Return PDF for download
            return response()->streamDownload(
                function () use ($pdf) {
                    echo $pdf->output();
                },
                'reporte-general-' . date('Y-m-d-H-i-s') . '.pdf',
                ['Content-Type' => 'application/pdf']
            );

        } catch (\Exception $e) {
            $this->dispatch('reporteError', 'Error al generar PDF: ' . $e->getMessage());
        }
    }

    public function exportCSV()
    {
        try {
            // Get the filtered data
            $query = Co::query();
            
            // Apply ALL filters exactly like in the render method
            // Filtro para 'id' basado en folioinit y foliofin
            if (
                (!is_null($this->folioinit) && $this->folioinit != 0) && ($this->folioinit != '') &&
                (is_null($this->foliofin) || $this->foliofin == 0)
            ) {
                $query->where('id', '=', $this->folioinit);
            } elseif (
                (!is_null($this->foliofin) && $this->foliofin != 0) && ($this->foliofin != '') &&
                (is_null($this->folioinit) || $this->folioinit == 0)
            ) {
                $query->where('id', '=', $this->foliofin);
            } elseif (
                (!is_null($this->folioinit) && $this->folioinit != 0) &&
                (!is_null($this->foliofin) && $this->foliofin != 0) &&
                $this->folioinit != $this->foliofin
            ) {
                $query->whereBetween('id', [
                    min($this->folioinit, $this->foliofin),
                    max($this->folioinit, $this->foliofin)
                ]);
            } elseif (
                (!is_null($this->folioinit) && $this->folioinit != 0) &&
                (!is_null($this->foliofin) && $this->foliofin != 0) &&
                $this->folioinit == $this->foliofin
            ) {
                $query->where('id', '=', $this->folioinit);
            }

            // Filtro por 'fcap' basado en fechas fcapini y fcapfin
            if (!is_null($this->fcapini) && is_null($this->fcapfin)) {
                $query->whereDate('fcap', '=', $this->fcapini);
            } elseif (is_null($this->fcapini) && !is_null($this->fcapfin)) {
                $query->whereDate('fcap', '=', $this->fcapfin);
            } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini == $this->fcapfin) {
                $query->whereDate('fcap', '=', $this->fcapini);
            } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini != $this->fcapfin) {
                $query->whereBetween('fcap', [
                    min($this->fcapini, $this->fcapfin),
                    max($this->fcapini, $this->fcapfin)
                ]);
            }

            // Filtro por 'frec' basado en fechas frecini y frecfin
            if (!is_null($this->frecini) && is_null($this->frecfin)) {
                $query->whereDate('frec', '=', $this->frecini);
            } elseif (is_null($this->frecini) && !is_null($this->frecfin)) {
                $query->whereDate('frec', '=', $this->frecfin);
            } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini == $this->frecfin) {
                $query->whereDate('frec', '=', $this->frecini);
            } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini != $this->frecfin) {
                $query->whereBetween('frec', [
                    min($this->frecini, $this->frecfin),
                    max($this->frecini, $this->frecfin)
                ]);
            }

            // Filtro por 'fofi' basado en fechas fofiini y fofifin
            if (!is_null($this->fofiini) && is_null($this->fofifin)) {
                $query->whereDate('fofi', '=', $this->fofiini);
            } elseif (is_null($this->fofiini) && !is_null($this->fofifin)) {
                $query->whereDate('fofi', '=', $this->fofifin);
            } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini == $this->fofifin) {
                $query->whereDate('fofi', '=', $this->fofiini);
            } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini != $this->fofifin) {
                $query->whereBetween('fofi', [
                    min($this->fofiini, $this->fofifin),
                    max($this->fofiini, $this->fofifin)
                ]);
            }

            // Filtros de texto
            if (!is_null($this->des) && $this->des !== '') {
                $query->where('des', 'like', '%' . $this->des . '%');
            }
            if (!is_null($this->seg) && $this->seg !== '') {
                $query->where('seguimiento', 'like', '%' . $this->seg . '%');
            }

            // Filtros de remitente
            if (!is_null($this->remnombre) && $this->remnombre !== '') {
                $query->where('rem_nombre', 'like', '%' . $this->remnombre . '%');
            }
            if (!is_null($this->remcargo) && $this->remcargo !== '') {
                $query->where('rem_cargo', 'like', '%' . $this->remcargo . '%');
            }
            if (!is_null($this->remdeporg) && $this->remdeporg !== '') {
                $query->where('rem_deporg', 'like', '%' . $this->remdeporg . '%');
            }

            // Filtros de turnado
            if (!is_null($this->turnom) && $this->turnom !== '') {
                $query->where('tur_nom', 'like', '%' . $this->turnom . '%');
            }
            if (!is_null($this->turcargo) && $this->turcargo !== '') {
                $query->where('tur_cargo', 'like', '%' . $this->turcargo . '%');
            }
            if (!is_null($this->turdeporg) && $this->turdeporg !== '') {
                $query->where('tur_deporg', 'like', '%' . $this->turdeporg . '%');
            }

            // Filtro por 'ncor' (N. Cor.)
            if (!is_null($this->ncor_filter) && $this->ncor_filter !== '' && $this->ncor_filter !== 'Seleccione una opción') {
                // Obtener el valor ncor de la tabla ncors basado en el ID seleccionado
                $ncorValue = Ncor::find($this->ncor_filter);
                if ($ncorValue) {
                    $query->where('ncor', '=', $ncorValue->ncor);
                }
            }

            // Filtro por 'tcor' (T. Cor.)
            if (!is_null($this->tcor_filter) && $this->tcor_filter !== '' && $this->tcor_filter !== 'Seleccione una opción') {
                // Obtener el valor tcor de la tabla tcors basado en el ID seleccionado
                $tcorValue = Tcor::find($this->tcor_filter);
                if ($tcorValue) {
                    $query->where('tcor', '=', $tcorValue->tcor);
                }
            }

            // Filtro por 'ccor' (Clas. Cor.)
            if (!is_null($this->ccor_filter) && $this->ccor_filter !== '' && $this->ccor_filter !== 'Seleccione una opción') {
                // Obtener el valor ccor de la tabla ccors basado en el ID seleccionado
                $ccorValue = Ccor::find($this->ccor_filter);
                if ($ccorValue) {
                    $query->where('ccor', '=', $ccorValue->ccor);
                }
            }

            // Get records with limit
            $registros = $query->select([
                'id', 'legislatura', 'fcap', 'frec', 'fofi', 'rem_nombre', 'rem_cargo', 
                'rem_deporg', 'rem_dir', 'tur_nom', 'tur_cargo', 'tur_deporg',
                'des', 'seguimiento', 'ncor', 'tcor', 'ccor'
            ])
            ->orderBy('id', 'desc')
            ->limit(5000)
            ->get();

            // Check if too many records
            if ($registros->count() >= 5000) {
                $this->dispatch('reporteError', 'Demasiados registros para exportar CSV (máximo 5000). Aplica más filtros para reducir los resultados.');
                return;
            }

            if ($registros->count() == 0) {
                $this->dispatch('reporteError', 'No se encontraron registros con los filtros aplicados.');
                return;
            }

            // Generate CSV
            $filename = 'reporte-general-' . date('Y-m-d-H-i-s') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($registros) {
                $file = fopen('php://output', 'w');
                
                // Add BOM for UTF-8
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                
                // Headers
                fputcsv($file, [
                    'Folio', 'Legislatura', 'Fecha Captura', 'Fecha Recepción', 'Fecha Oficio',
                    'Remitente Nombre', 'Remitente Cargo', 'Remitente Dependencia', 'Remitente Dirección',
                    'Turnado Nombre', 'Turnado Cargo', 'Turnado Dependencia',
                    'Descripción', 'Seguimiento', 'Nivel Corresp.', 'Tipo Corresp.', 'Clas. Corresp.'
                ]);
                
                // Data
                foreach ($registros as $registro) {
                    fputcsv($file, [
                        $registro->id,
                        $registro->legislatura,
                        $registro->fcap ? date('d/m/Y', strtotime($registro->fcap)) : '',
                        $registro->frec ? date('d/m/Y', strtotime($registro->frec)) : '',
                        $registro->fofi ? date('d/m/Y', strtotime($registro->fofi)) : '',
                        $registro->rem_nombre,
                        $registro->rem_cargo,
                        $registro->rem_deporg,
                        $registro->rem_dir,
                        $registro->tur_nom,
                        $registro->tur_cargo,
                        $registro->tur_deporg,
                        $registro->des,
                        $registro->seguimiento,
                        $registro->ncor,
                        $registro->tcor,
                        $registro->ccor
                    ]);
                }
                
                fclose($file);
            };

            // Dispatch success event
            $this->dispatch('reporteGenerado', 'CSV generado correctamente con ' . $registros->count() . ' registros.');

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            $this->dispatch('reporteError', 'Error al generar CSV: ' . $e->getMessage());
        }
    }

    public function openViewQuery()
    {
        // This method can be used to show the current query or toggle query visibility
        // For now, we'll just toggle the accordion to show/hide filters
        $this->toggleAccordion();
    }

    public function mount()
    {
        $this->Nccors = Ncor::all();
        $this->Tccors = Tcor::all();
        $this->Cccors = Ccor::all();
        $this->userGroups = UserGroup::active()->get();
    }

//    reportes --------------------------------------------------------------------------------------------------------
//   ejecutar esto :::   php artisan storage:link
    public function generarReporte($id, $tipoReporte)
    {
        $registro = Co::find($id);

        if (!$registro) {
            $this->dispatch('reporteError', 'Registro no encontrado.');
            return;
        }

        switch ($tipoReporte) {
            case 'reporte1':
                return redirect()->route('reporteNormal', ['id' => $id, 'tipoReporte' => 'reporte1']);
            //$this->generarPDF($registro, 'reporte1');
            case 'reporte2':
                return redirect()->route('reporteEspecial', ['id' => $id, 'tipoReporte' => 'reporte2']);
            case 'reporte3':
                return redirect()->route('reporteSolicitud', ['id' => $id, 'tipoReporte' => 'reporte3']);
        }
    }

    private function generarPDF($registro, $tipoReporte)
    {
        // Seleccionar la vista del reporte según el tipo
        $view = match ($tipoReporte) {
            'reporte1' => 'reports.report1',
            'reporte2' => 'reports.reporte2',
            'reporte3' => 'reports.reporte3',
        };


        // Renderizar la vista con los datos
        $pdf = Pdf::loadView($view, ['registro' => $registro]);
        // Guardar el PDF en el almacenamiento local (opcional)
        $filename = "reporte-{$tipoReporte}-{$registro->id}.PDF";
        Storage::put("public/reports/{$filename}", $pdf->output());
        // Descarga directa del archivo
        return Response::streamDownload(fn () => print($pdf->stream()), $filename );
        return Pdf::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
    }




//   fin de reportes---------------------------------------------------------------------------------------------------



//**********************************************************************************************************************
//**********************************************************************************************************************
//**********************************************************************************************************************




    public function render()
    {
        // Inicia la consulta base
        $query = Co::query();
        // Filtro para 'id' basado en folioinit y foliofin
        if (
            (!is_null($this->folioinit) && $this->folioinit != 0) && ($this->folioinit != '') &&
            (is_null($this->foliofin) || $this->foliofin == 0)
        ) {
            $query->where('id', '=', $this->folioinit);
        } elseif (
            (!is_null($this->foliofin) && $this->foliofin != 0) && ($this->foliofin != '') &&
            (is_null($this->folioinit) || $this->folioinit == 0)
        ) {
            $query->where('id', '=', $this->foliofin);
        } elseif (
            (!is_null($this->folioinit) && $this->folioinit != 0) &&
            (!is_null($this->foliofin) && $this->foliofin != 0) &&
            $this->folioinit != $this->foliofin
        ) {
            $query->whereBetween('id', [
                min($this->folioinit, $this->foliofin),
                max($this->folioinit, $this->foliofin)
            ]);
        } elseif (
            (!is_null($this->folioinit) && $this->folioinit != 0) &&
            (!is_null($this->foliofin) && $this->foliofin != 0) &&
            $this->folioinit == $this->foliofin
        ) {
            $query->where('id', '=', $this->folioinit);
        }
        // Filtro por 'fcap' basado en fechas fcapini y fcapfin ------------------------------------------------------------------------------------------------------
        if (!is_null($this->fcapini) && is_null($this->fcapfin)) {
            // Caso 1: fcapini tiene valor y fcapfin es nulo
            $query->whereDate('fcap', '=', $this->fcapini);
        } elseif (is_null($this->fcapini) && !is_null($this->fcapfin)) {
            // Caso 2: fcapfin tiene valor y fcapini es nulo
            $query->whereDate('fcap', '=', $this->fcapfin);
        } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini == $this->fcapfin) {
            // Caso 3: Ambos valores son iguales
            $query->whereDate('fcap', '=', $this->fcapini);
        } elseif (!is_null($this->fcapini) && !is_null($this->fcapfin) && $this->fcapini != $this->fcapfin) {
            // Caso 4: Valores diferentes, aplicar rango
            $query->whereBetween('fcap', [
                min($this->fcapini, $this->fcapfin),
                max($this->fcapini, $this->fcapfin)
            ]);
        }
        //   frecini    frecfin ----------------------------------------------------------------------------------------------------------------------------------------
        // Filtro por 'frec' basado en fechas frecini y   frecfin ------------------------------------------------------------------------------------------------------
        if (!is_null($this->frecini) && is_null($this->frecfin)) {
            // Caso 1: frecini tiene valor y frecfin es nulo
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (is_null($this->frecini) && !is_null($this->frecfin)) {
            // Caso 2: frecfin tiene valor y frecini es nulo
            $query->whereDate('frec', '=', $this->frecfin);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini == $this->frecfin) {
            // Caso 3: Ambos valores son iguales
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini != $this->frecfin) {
            // Caso 4: Valores diferentes, aplicar rango
            $query->whereBetween('frec', [
                min($this->frecini, $this->frecfin),
                max($this->frecini, $this->frecfin)
            ]);
        }
        // Filtro por 'frec' basado en fechas fofiini y fofifin ------------------------------------------------------------------------------------------------------
        if (!is_null($this->frecini) && is_null($this->frecfin)) {
            // Caso 1: frecini tiene valor y frecfin es nulo
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (is_null($this->frecini) && !is_null($this->frecfin)) {
            // Caso 2: frecfin tiene valor y frecini es nulo
            $query->whereDate('frec', '=', $this->frecfin);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini == $this->frecfin) {
            // Caso 3: Ambos valores son iguales
            $query->whereDate('frec', '=', $this->frecini);
        } elseif (!is_null($this->frecini) && !is_null($this->frecfin) && $this->frecini != $this->frecfin) {
            // Caso 4: Valores diferentes, aplicar rango
            $query->whereBetween('frec', [
                min($this->frecini, $this->frecfin),
                max($this->frecini, $this->frecfin)
            ]);
        }
        // Filtro por 'fofi' basado en fechas fofiini y fofifin ------------------------------------------------------------------------------------------------------
        if (!is_null($this->fofiini) && is_null($this->fofifin)) {
            // Caso 1: fofiini tiene valor y fofifin es nulo
            $query->whereDate('fofi', '=', $this->fofiini);
        } elseif (is_null($this->fofiini) && !is_null($this->fofifin)) {
            // Caso 2: fofifin tiene valor y fofiini es nulo
            $query->whereDate('fofi', '=', $this->fofifin);
        } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini == $this->fofifin) {
            // Caso 3: Ambos valores son iguales
            $query->whereDate('fofi', '=', $this->fofiini);
        } elseif (!is_null($this->fofiini) && !is_null($this->fofifin) && $this->fofiini != $this->fofifin) {
            // Caso 4: Valores diferentes, aplicar rango
            $query->whereBetween('fofi', [
                min($this->fofiini, $this->fofifin),
                max($this->fofiini, $this->fofifin)
            ]);
        }
        //--------------------------------------------------------------------------------------------------------------
        if (!is_null($this->des) && $this->des !== '') {
            $query->where('des', 'like', '%' . $this->des . '%');
        }
        if (!is_null($this->seg) && $this->seg !== '') {
            $query->where('seguimiento', 'like', '%' . $this->seg . '%');
        }
        //--------------------------------------------------------------------------------------------------------------
        // Filtro por 'rem_nombre' si contiene información
        if (!is_null($this->remnombre) && $this->remnombre !== '') {
            $query->where('rem_nombre', 'like', '%' . $this->remnombre . '%');
        }
        // Filtro por 'rem_cargo' si contiene información
        if (!is_null($this->remcargo) && $this->remcargo !== '') {
            $query->where('rem_cargo', 'like', '%' . $this->remcargo . '%');
        }
        // Filtro por 'rem_deporg' si contiene información
        if (!is_null($this->remdeporg) && $this->remdeporg !== '') {
            $query->where('rem_deporg', 'like', '%' . $this->remdeporg . '%');
        }
        // -------------------------------------------------------------------------------------------------------------
        // Filtro por 'tur_nom' si contiene información
        if (!is_null($this->turnom) && $this->turnom !== '') {
            $query->where('tur_nom', 'like', '%' . $this->turnom . '%');
        }
        // Filtro por 'tur_cargo' si contiene información
        if (!is_null($this->turcargo) && $this->turcargo !== '') {
            $query->where('tur_cargo', 'like', '%' . $this->turcargo . '%');
        }
        // Filtro por 'tur_deporg' si contiene información
        if (!is_null($this->turdeporg) && $this->turdeporg !== '') {
            $query->where('tur_deporg', 'like', '%' . $this->turdeporg . '%');
        }

        // Filtro por 'ncor' (N. Cor.)
        if (!is_null($this->ncor_filter) && $this->ncor_filter !== '' && $this->ncor_filter !== 'Seleccione una opción') {
            // Obtener el valor ncor de la tabla ncors basado en el ID seleccionado
            $ncorValue = Ncor::find($this->ncor_filter);
            if ($ncorValue) {
                $query->where('ncor', '=', $ncorValue->ncor);
            }
        }

        // Filtro por 'tcor' (T. Cor.)
        if (!is_null($this->tcor_filter) && $this->tcor_filter !== '' && $this->tcor_filter !== 'Seleccione una opción') {
            // Obtener el valor tcor de la tabla tcors basado en el ID seleccionado
            $tcorValue = Tcor::find($this->tcor_filter);
            if ($tcorValue) {
                $query->where('tcor', '=', $tcorValue->tcor);
            }
        }

        // Filtro por 'ccor' (Clas. Cor.)
        if (!is_null($this->ccor_filter) && $this->ccor_filter !== '' && $this->ccor_filter !== 'Seleccione una opción') {
            // Obtener el valor ccor de la tabla ccors basado en el ID seleccionado
            $ccorValue = Ccor::find($this->ccor_filter);
            if ($ccorValue) {
                $query->where('ccor', '=', $ccorValue->ccor);
            }
        }

        // ++++++++++---------------------------------------------------------------------------------------------------


        // ++++++++++---------------------------------------------------------------------------------------------------
        // ++++++++++---------------------------------------------------------------------------------------------------

        // Paginación y retorno a la vista
        $sqlWithBindings = vsprintf(
            str_replace('?', "'%s'", $query->toSql()),
            collect($query->getBindings())->map(function ($binding) {
                return addslashes($binding);
            })->toArray()
        );
        return view('livewire.reportesgral.index', [
            'cos' => $query->orderBy('id', 'desc')->paginate($this->NumPag),
            'myquery' => $sqlWithBindings,
        ]);

//        return view('livewire.reportesgral.index', [
//            'cos' => $query->paginate($this->NumPag),
//            'myquery' => $sqlWithBindings,
//        ]);
    }
}
