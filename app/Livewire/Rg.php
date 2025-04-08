<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;  //pdf
use Illuminate\Support\Facades\Response;  //pdf
use Barryvdh\DomPDF\Facade\Pdf;  // import dompdf
use App\Models\Co;
use App\Models\Ncor;
use App\Models\Tcor;
use App\Models\Ccor;

class Rg extends Component
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
    //    begin     open modal
    public $isOpen = true;

    //    end     open modal

    public function toggleAccordion()
    {
        $this->isOpen = !$this->isOpen; // Alterna entre abierto y cerrado
    }

    public function mount()
    {
        $this->Nccors = Ncor::all();
        $this->Tccors = Tcor::all();
        $this->Cccors = Ccor::all();
    }

//    reportes --------------------------------------------------------------------------------------------------------
//   ejecutar esto :::   php artisan storage:link
    public function generarReporte($id, $tipoReporte)
    {
        $registro = Co::find($id);

        if (!$registro) {
            $this->dispatchBrowserEvent('reporteError', ['mensaje' => 'Registro no encontrado.']);
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
        return view('livewire.rg', [
            'cos' => $query->orderBy('id', 'desc')->paginate($this->NumPag),
            'myquery' => $sqlWithBindings,
        ]);

//        return view('livewire.rg', [
//            'cos' => $query->paginate($this->NumPag),
//            'myquery' => $sqlWithBindings,
//        ]);
    }
}
