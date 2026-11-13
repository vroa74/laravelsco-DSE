<div class="text-primary">


    <div id="accordion-collapse" class="items-center w-full mx-auto text-center">
        <h2 id="accordion-collapse-heading-1">
            <div class="relative">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-stretch">
                    <!-- Botón de filtros -->
                    <button
                        type="button"
                        class="filter-toggle flex w-full items-center justify-between gap-3 rounded-xl border border-primary  px-4 py-2.5 text-sm font-medium  transition  focus:outline-none focus:ring-4 focus:ring-primary/50 sm:flex-1"
                        wire:click="toggleAccordion"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="accordion-collapse-body-1">
                        <span class="inline-flex items-center gap-2">
                            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                            Filtros
                        </span>

                        <svg
                            class="w-5 h-5 transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6"
                            stroke="currentColor"
                            stroke-width="2"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>

                    <!-- Acciones de la barra: solo iconos con tooltip -->
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-end">
                        <x-icon-action variant="success" icon="fa-regular fa-square-plus"
                            :href="route('rg.create')" label="Agregar registro" />

                        <x-icon-action variant="export-pdf" icon="fa-solid fa-file-pdf" label="Exportar a PDF"
                            wire:click="exportPDF" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" />

                        <x-icon-action variant="export-csv" icon="fa-solid fa-file-csv" label="Exportar a CSV"
                            wire:click="exportCSV" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" />

                        <x-icon-action variant="info" icon="fa-solid fa-filter" label="Aplicar filtros"
                            wire:click="openViewQuery" />
                    </div>
                </div>
            </div>
        </h2>

        <div id="accordion-collapse-body-1"
             class="{{ $isOpen ? '' : 'hidden' }} p-1 border border-primary panel-base">
            {{--      begin section containes filter--}}

                <div class="grid w-full h-full grid-cols-1 gap-1 px-2 sm:grid-cols-2 sm:px-4 xl:grid-cols-4">
                    <div class="items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        {{-- inline-block se usa para un tamaño especifico           --}}
                        <label class="label-base">Mostrar:</label>
                        <select
                            id="countries"
                            wire:model.live="NumPag"
                            class="input-base inline-block w-auto p-1 text-xs">
                            <option value="10" selected>Registros a mostrar</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                        <span class="text-secondary">Registros.</span>
                    </div>
                    {{--   fin  numero de registros a mostrar----------------------------------------------------}}
                    {{--            filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        {{-- Public folioinit, foliofin --}}
                        <div class="flex flex-wrap items-center justify-center gap-1">
                            <label class="label-base">Folio</label>
                            <input type="number"
                                   id="folio_init"
                                   wire:model.live="folioinit"
                                   class="input-base w-[144px] p-1 text-xs">
                            <label class="label-base">al</label>
                            <input type="number"
                                   id="folio_fin"
                                   wire:model.live="foliofin"
                                   class="input-base w-[144px] p-1 text-xs">
                        </div>
                    </div>
                    {{--           fin filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
                    {{--        filtro por descripcion u por seguimiento -----------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        <div class="flex flex-wrap items-center justify-center gap-1">
                            <label class="label-base">Des.</label>
                            <input type="text"
                                   id="des"
                                   wire:model.live="des"
                                   class="input-base w-[80px] p-1 text-xs">
                            <label class="label-base">Seg.</label>
                            <input type="text"
                                   id="seg"
                                   wire:model.live="seg"
                                   class="input-base w-[80px] p-1 text-xs">
                        </div>
                    </div>
                    {{--        fin filtro por descripcion u por seguimiento -----------------------------------------------------------}}
                    {{--        filtro por estatus de la correspondencia ------------------------------------------------------}}
                    <div class="p-1 text-center border-2 border-primary rounded-lg">
                        {{-- estatus --}}
                        <p class="text-secondary">Total paginado: {{ $cos->total() }}</p>
                        <p class="text-secondary">Total filtrado: {{ $this->getFilteredCount() }}</p>
                        <p class="text-xs text-muted">Límite PDF: 2000 | CSV: 5000</p>
                        <p class="text-secondary">{{ $myquery }}</p>
                    </div>
                    {{--        fin filtro por estatus de la correspondencia ------------------------------------------------------}}
                    {{--         filtro por fechas ---------------------------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="fcapini" class="label-base">F. Cap.</label>
                            <div class="relative">
                                <input
                                    id="fcapini"
                                    type="date"
                                    wire:model.live="fcapini"
                                    class="input-base block w-[144px] p-1 text-xs"
                                    placeholder="YYYY/MM/DD"
                                />
                            </div>
                            <label for="fcapfin" class="label-base">Al</label>
                            <div class="relative">
                                <input id="fcapfin"
                                       type="date"
                                       wire:model.live="fcapfin"
                                       data-date-format="yyyy/mm/dd"
                                       placeholder="YYYY/MM/DD"
                                       class="input-base block w-[144px] p-1 text-xs" placeholder="Date">
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="remcargoini" class="label-base">F. Rec</label>
                            <div class="relative">
                                <input id="remcargoini"
                                       type="date"
                                       wire:model.live="remcargoini"
                                       class="input-base block w-[144px] p-1 text-xs" placeholder="Date">
                            </div>
                            <label for="remcargofin" class="label-base">Al</label>
                            <div class="relative">
                                <input id="remcargofin"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remcargofin"
                                       class="input-base block w-[144px] p-1 text-xs" placeholder="Date">
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="remdeporgini" class="label-base">F. Ofi.</label>
                            <div class="relative">
                                <input id="remdeporgini"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remdeporgini"
                                       class="input-base block w-[144px] p-1 text-xs" placeholder="Date">
                            </div>

                            <label for="remdeporgfin" class="label-base">Al</label>
                            <div class="relative">
                                <input id="remdeporgfin"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remdeporgfin"
                                       class="input-base block w-[144px] p-1 text-xs" placeholder="Date">
                            </div>
                        </div>
                        {{ $fcapini }} - {{ $fcapfin }}
                    </div>
                    {{--       fin  filtro por fechas ---------------------------------------------------------------------------}}
                    {{--            filtro por remitente ------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Rem. Nom.</label>
                            <input type="text"
                                   id="remnombre"
                                   wire:model.live="remnombre"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Rem. Cargo</label>
                            <input type="text"
                                   id="remcargo"
                                   wire:model.live="remcargo"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Rem. Dep.</label>
                            <input type="text"
                                   id="remdeporg"
                                   wire:model.live="remdeporg"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                    </div>
                    {{--          fin  filtro por remitente ------------------------------------------------------}}
                    {{--                filtro por elementos turnado -------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Tur. Nom.</label>
                            <input type="text"
                                   id="turnom"
                                   wire:model.live="turnom"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Tur. Car.</label>
                            <input type="text"
                                   id="turcargo"
                                   wire:model.live="turcargo"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <label class="label-base">Tur. Dep.</label>
                            <input type="text"
                                   id="turdeporg"
                                   wire:model.live="turdeporg"
                                   class="input-base w-[160px] p-1 text-xs">
                        </div>
                    </div>
                    {{--             fin   filtro por elementos turnado -------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-primary rounded-lg">
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="nnncor" class="label-base">N. Cor.</label>
                            <!-- Select -->
                            <select id="nnncor"
                                    wire:model.live="ncor_filter"
                                    class="input-base block w-[120px] p-1 text-xs">
                                <option value="">Seleccione una opción</option>
                                @foreach($Nccors as $Nccor)
                                    <option value="{{ $Nccor->id }}">{{ $Nccor->ncor }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="tttcor" class="label-base">T. Cor.</label>
                            <!-- Select -->
                            <select id="tttcor"
                                    wire:model.live="tcor_filter"
                                    class="input-base block w-[120px] p-1 text-xs">
                                <option value="">Seleccione una opción</option>
                                @foreach($Tccors as $Tccor)
                                    <option value="{{ $Tccor->id }}">{{ $Tccor->tcor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="cccor" class="label-base">Clas. Cor</label>
                            <!-- Select -->
                            <select id="cccor"
                                    wire:model.live="ccor_filter"
                                    class="input-base block w-[120px] p-1 text-xs">
                                <option value="">Seleccione una opción</option>
                                @foreach($Cccors as $Cccor)
                                    <option value="{{ $Cccor->id }}">{{ $Cccor->ccor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}



           {{--      end section containes filter--}}

        </div>
</div>




{{--     numero de registros a mostrar----------------------------------------------------}}

    <div class="relative pt-4 panel-base overflow-x-auto">
        <table class="tabla-apilada text-xs text-center text-secondary"  >
            <thead class="text-primary">
            <tr>
                <th scope="col" class="px-6 py-3 w-[4%]">
                    id
                </th>
                <th scope="col" class="px-6 py-3 w-[10%]">
                     Correspondencia
                </th>
                <th scope="col" class="px-6 py-3 w-[10%]">
                    fecha
                </th>
                <th scope="col" class="px-6 py-3 w-[15%]">
                    remitente
                </th>
                <th scope="col" class="px-6 py-3 w-[15%]">
                    turnado
                </th>
                <th scope="col" class="px-6 py-3 w-[20%]">
                    descripcion
                </th>
                <th scope="col" class="px-6 py-3 w-[15%]">
                    Seguimiento
                </th>
                <th scope="col" class="px-2 py-3 w-[210px]">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach ($cos as $co)
                @if($co->estatus)
                       <tr class="state-hover">
                      @else
                      <tr class="state-hover"  >
                @endif
                <td class="px-3 py-2" data-label="Id">
                    {{$co->id}}
                    <p class="text-muted">{{ $co->legislaturaRel->legislatura ?? $co->legislatura }}</p>
                </td>
                <td class="px-3 py-2" data-label="Correspondencia">
                    @if(!empty($co->ncor))
                    <p> <span class="text-muted"> Nivel: </span>   {{ $co->ncor  }}</p>
                    @endif
                    @if(!empty($co->tcor))
                    <p> <span class="text-muted"> Tipo: </span>   {{ $co->tcor  }}</p>
                    @endif
                    @if(!empty($co->ccor))
                        <p> <span class="text-muted"> Clas.: </span> {{ $co->ccor }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Fecha">

                    @if(!empty($co->fcap))
                        <p> <span class="text-muted" >Cap.: </span> {{ $co->fcap  }}</p>
                    @endif
                    @if(!empty($co->frec))
                        <p> <span class="text-muted" >Rec.: </span>  {{ $co->frec  }}</p>
                    @endif
                    @if(!empty($co->fofi))
                        <p> <span class="text-muted" >Ofi.: </span>  {{ $co->fofi  }}</p>
                    @endif
                    @if(!empty($co->nhoj))
                        <p> <span class="text-muted" ># hojas: </span>  {{ $co->nhoj  }}</p>
                    @endif
                    @if(!empty($co->nofi))
                        <p> <span class="text-muted" ># oficio: </span>  {{ $co->nofi  }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Remitente">
                    @if(!empty($co->rem_nombre))
                    <p> <span class="text-muted" >Nombre:</span>  {{ $co->rem_nombre  }}</p>
                    @endif
                    @if(!empty($co->rem_cargo))
                    <p> <span class="text-muted" >Cargo:</span>   {{ $co->rem_cargo  }}</p>
                    @endif
                    @if(!empty($co->rem_deporg))
                    <p> <span class="text-muted" >Dep. Org.:</span>   {{ $co->rem_deporg  }}</p>
                    @endif
                    @if(!empty($co->rem_dir))
                    <p> <span class="text-muted" >Dir.:</span>  {{ $co->rem_dir  }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Turnado a">
                    @if(!empty($co->tur_nom))
                    <p> <span class="text-muted" >nombre: </span> {{ $co->tur_nom  }}</p>
                    @endif
                    @if(!empty($co->tur_cargo))
                    <p> <span class="text-muted" >Cargo: </span> {{ $co->tur_cargo  }}</p>
                    @endif
                    @if(!empty($co->tur_deporg))
                    <p> <span class="text-muted" >Dep. Org.: </span> {{ $co->tur_deporg  }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Descripción">
                    <p>{{ $co->des  }}</p>
                </td>
                <td class="px-3 py-2" data-label="Seguimiento">
                    <p>{{ $co->seguimiento  }}</p>
                </td>
                <td class="px-3 py-2" data-label="Acciones">
                    <div class="flex flex-wrap items-center justify-center gap-2">
                        <x-icon-action variant="view" icon="fa-regular fa-eye" :href="route('rg.show', $co->id)"
                            label="Ver detalles" />

                        <x-icon-action variant="warning" icon="fa-solid fa-pencil" :href="route('rg.edit', $co->id)"
                            label="Editar registro" />

                        <x-icon-action variant="report-normal" icon="fa-regular fa-rectangle-list" href="javascript:void(0)"
                            onclick="abrirReporte({{ $co->id }}, 'reporte1')" label="Generar reporte normal" />

                        <x-icon-action variant="report-special" icon="fa-solid fa-bars" href="javascript:void(0)"
                            onclick="abrirReporte({{ $co->id }}, 'reporte2')" label="Generar reporte especial" />

                        <x-icon-action variant="report-request" icon="fa-solid fa-list" href="javascript:void(0)"
                            onclick="abrirReporte({{ $co->id }}, 'reporte3')" label="Generar reporte de solicitud" />
                    </div>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    {{$cos}}
    <br>
{{-- escrip del reporte--}}
    <script>
        document.addEventListener('livewire:init', () => {
            console.log('Livewire initialized');

            Livewire.on('reporteGenerado', (mensaje) => {
                console.log('Evento reporteGenerado recibido:', mensaje);
                alert('Éxito: ' + mensaje);
            });

            Livewire.on('reporteError', (mensaje) => {
                console.log('Evento reporteError recibido:', mensaje);
                alert('Error: ' + mensaje);
            });
        });

        // Función para abrir reportes en nueva ventana
        function abrirReporte(id, tipo) {
            // Configuración de la ventana
            const windowFeatures = 'width=1200,height=800,scrollbars=yes,resizable=yes,menubar=yes,toolbar=yes,location=yes,status=yes';

            // URL base para los reportes usando las rutas correctas
            let url = '';

            switch(tipo) {
                case 'reporte1':
                    url = `/reporte-normal/${id}/reporte1`;
                    break;
                case 'reporte2':
                    url = `/reporte-especial/${id}/reporte2`;
                    break;
                case 'reporte3':
                    url = `/reporte-solicitud/${id}/reporte3`;
                    break;
                default:
                    console.error('Tipo de reporte no válido');
                    return;
            }

            // Abrir nueva ventana
            const nuevaVentana = window.open(url, '_blank', windowFeatures);

            // Verificar si la ventana se abrió correctamente
            if (nuevaVentana) {
                nuevaVentana.focus();
            } else {
                alert('No se pudo abrir la ventana. Verifica que el bloqueador de ventanas emergentes esté desactivado.');
            }
        }
    </script>

</div> {{--  final de componente    --}}
