<div class="text-stone-200">


    <div id="accordion-collapse" class="items-center w-full mx-auto text-center">
        <h2 id="accordion-collapse-heading-1">
            <div class="relative">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-stretch">
                    <!-- Botón de filtros -->
                    <button
                        type="button"
                        class="flex w-full items-center justify-between gap-3 rounded-xl border border-gray-700 bg-blue-950 px-4 py-2.5 text-sm font-medium text-gray-200 transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-gray-700 sm:flex-1"
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

                        <x-icon-action variant="danger" icon="fa-solid fa-file-pdf" label="Exportar a PDF"
                            wire:click="exportPDF" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" />

                        <x-icon-action variant="warning" icon="fa-solid fa-file-csv" label="Exportar a CSV"
                            wire:click="exportCSV" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed" />

                        <x-icon-action variant="info" icon="fa-solid fa-filter" label="Aplicar filtros"
                            wire:click="openViewQuery" />
                    </div>
                </div>
            </div>
        </h2>

        <div id="accordion-collapse-body-1"
             class="{{ $isOpen ? '' : 'hidden' }} p-1 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            {{--      begin section containes filter--}}

                {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}
                <div class="grid w-full h-full grid-cols-1 gap-1 px-2 sm:grid-cols-2 sm:px-4 xl:grid-cols-4">
                    <div class="items-center p-1 space-y-1 text-center border-2 border-red-400 rounded-lg">
                        {{-- inline-block se usa para un tamaño especifico           --}}
                        Mostrar:: <select
                            id="countries"
                            wire:model.live="NumPag"
                            class="inline-block w-auto p-1 text-xs text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="10" selected>Registros a mostrar</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select> Registros.
                    </div>
                    {{--   fin  numero de registros a mostrar----------------------------------------------------}}
                    {{--            filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-blue-400 rounded-lg">
                        {{-- Public folioinit, foliofin --}}
                        <div class="flex flex-wrap items-center justify-center gap-1">
                            <span class="text-sm">Folio</span>
                            <input type="number"
                                   id="folio_init"
                                   wire:model.live="folioinit"
                                   class="w-[100px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <span class="text-sm">al</span>
                            <input type="number"
                                   id="folio_fin"
                                   wire:model.live="foliofin"
                                   class="w-[100px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    {{--           fin filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
                    {{--        filtro por descripcion u por seguimiento -----------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-green-400 rounded-lg">
                        <div class="flex flex-wrap items-center justify-center gap-1">
                            <span class="text-sm">Des.</span>
                            <input type="text"
                                   id="des"
                                   wire:model.live="des"
                                   class="w-[80px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <span class="text-sm">Seg.</span>
                            <input type="text"
                                   id="seg"
                                   wire:model.live="seg"
                                   class="w-[80px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    {{--        fin filtro por descripcion u por seguimiento -----------------------------------------------------------}}
                    {{--        filtro por estatus de la correspondencia ------------------------------------------------------}}
                    <div class="p-1 text-center border-2 border-yellow-400 rounded-lg">
                        {{-- estatus --}}
                        <p>Total paginado: {{ $cos->total() }}</p>
                        <p>Total filtrado: {{ $this->getFilteredCount() }}</p>
                        <p class="text-xs text-orange-600">Límite PDF: 2000 | CSV: 5000</p>
                        <p>{{ $myquery }}</p>
                    </div>
                    {{--        fin filtro por estatus de la correspondencia ------------------------------------------------------}}
                    {{--         filtro por fechas ---------------------------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-purple-400 rounded-lg">
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="fcapini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Cap.</label>
                            <div class="relative">
                                <input
                                    id="fcapini"
                                    type="date"
                                    wire:model.live="fcapini"
                                    class="bg-gray-800 border border-gray-600 text-white text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="YYYY/MM/DD"
                                />
                            </div>
                            <label for="fcapfin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>
                            <div class="relative">
                                <input id="fcapfin"
                                       type="date"
                                       wire:model.live="fcapfin"
                                       data-date-format="yyyy/mm/dd"
                                       placeholder="YYYY/MM/DD"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="remcargoini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Rec</label>
                            <div class="relative">
                                <input id="remcargoini"
                                       type="date"
                                       wire:model.live="remcargoini"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">
                            </div>
                            <label for="remcargofin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>
                            <div class="relative">
                                <input id="remcargofin"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remcargofin"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">
                            </div>
                        </div>
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <label for="remdeporgini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Ofi.</label>
                            <div class="relative">
                                <input id="remdeporgini"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remdeporgini"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">
                            </div>

                            <label for="remdeporgfin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>
                            <div class="relative">
                                <input id="remdeporgfin"
                                       type="date"
                                       {{--                           datepicker--}}
                                       wire:model.live="remdeporgfin"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">
                            </div>
                        </div>
                        {{ $fcapini }} - {{ $fcapfin }}
                    </div>
                    {{--       fin  filtro por fechas ---------------------------------------------------------------------------}}
                    {{--            filtro por remitente ------------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-pink-400 rounded-lg">
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Rem. Nom.</span>
                            <input type="text"
                                   id="remnombre"
                                   wire:model.live="remnombre"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Rem. Cargo</span>
                            <input type="text"
                                   id="remcargo"
                                   wire:model.live="remcargo"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Rem. Dep.</span>
                            <input type="text"
                                   id="remdeporg"
                                   wire:model.live="remdeporg"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    {{--          fin  filtro por remitente ------------------------------------------------------}}
                    {{--                filtro por elementos turnado -------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-teal-400 rounded-lg">
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Tur. Nom.</span>
                            <input type="text"
                                   id="turnom"
                                   wire:model.live="turnom"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Tur. Car.</span>
                            <input type="text"
                                   id="turcargo"
                                   wire:model.live="turcargo"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center p-0 space-x-1">
                            <span class="text-sm">Tur. Dep.</span>
                            <input type="text"
                                   id="turdeporg"
                                   wire:model.live="turdeporg"
                                   class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    {{--             fin   filtro por elementos turnado -------------------------------------------------}}
                    <div class="flex flex-col items-center p-1 space-y-1 text-center border-2 border-orange-400 rounded-lg">
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="nnncor" class="text-xs font-medium text-gray-900 dark:text-white">N. Cor.</label>
                            <!-- Select -->
                            <select id="nnncor"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Seleccione una opción</option>
                                @foreach($Nccors as $Nccor)
                                    <option value=" {{ $Nccor->id }} "> {{ $Nccor->ncor }} </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="tttcor" class="text-xs font-medium text-gray-900 dark:text-white">T. Cor.</label>
                            <!-- Select -->
                            <select id="tttcor" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </div>
                        <div class="flex items-center max-w-sm mx-auto space-x-2">
                            <!-- Label -->
                            <label for="cccor" class="text-xs font-medium text-gray-900 dark:text-white">Clas. Cor</label>
                            <!-- Select -->
                            <select id="cccor" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}



           {{--      end section containes filter--}}

        </div>
    </div>




{{--     numero de registros a mostrar----------------------------------------------------}}

    <div class="relative pt-4 shadow-md sm:rounded-lg">
        <table class="tabla-apilada text-xs text-center text-gray-500 bg-blue-900 rtl:text-right dark:text-gray-400 dark:hover:font-bold dark:hover:bg-blue-950"  >
            <thead>
            <tr>
                <th scope="col" class="px-6 py-3 w-[4%]">
                    id
                </th>
                <th scope="col" class="px-6 py-3 w-[4%]">
                    Legis.
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
                       <tr class="bg-white border-b dark:bg-red-950 dark:border-red-800 hover:bg-gray-50 dark:hover:bg-red-900 dark:hover:text-base ">
                      @else
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 dark:hover:text-black dark:hover:text-base "  >
                @endif
                <td class="px-3 py-2" data-label="Id">
                    {{$co->id}}
                </td>
                <td class="px-3 py-2" data-label="Legislatura">
                    {{ $co->legislatura  }}
                </td>
                <td class="px-3 py-2" data-label="Correspondencia">
                    @if(!empty($co->ncor))
                    <p> <span class="text-yellow-300"> Nivel: </span>   {{ $co->ncor  }}</p>
                    @endif
                    @if(!empty($co->tcor))
                    <p> <span class="text-yellow-300"> Tipo: </span>   {{ $co->tcor  }}</p>
                    @endif
                    @if(!empty($co->ccor))
                        <p> <span class="text-yellow-300"> Clas.: </span> {{ $co->ccor }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Fecha">

                    @if(!empty($co->fcap))
                        <p> <span class="text-yellow-300" >Cap.: </span> {{ $co->fcap  }}</p>
                    @endif
                    @if(!empty($co->frec))
                        <p> <span class="text-yellow-300" >Rec.: </span>  {{ $co->frec  }}</p>
                    @endif
                    @if(!empty($co->fofi))
                        <p> <span class="text-yellow-300" >Ofi.: </span>  {{ $co->fofi  }}</p>
                    @endif
                    @if(!empty($co->nhoj))
                        <p> <span class="text-yellow-300" ># hojas: </span>  {{ $co->nhoj  }}</p>
                    @endif
                    @if(!empty($co->nofi))
                        <p> <span class="text-yellow-600" ># oficio: </span>  {{ $co->nofi  }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Remitente">
                    @if(!empty($co->rem_nombre))
                    <p> <span class="text-yellow-300" >Nombre:</span>  {{ $co->rem_nombre  }}</p>
                    @endif
                    @if(!empty($co->rem_cargo))
                    <p> <span class="text-yellow-300" >Cargo:</span>   {{ $co->rem_cargo  }}</p>
                    @endif
                    @if(!empty($co->rem_deporg))
                    <p> <span class="text-yellow-300" >Dep. Org.:</span>   {{ $co->rem_deporg  }}</p>
                    @endif
                    @if(!empty($co->rem_dir))
                    <p> <span class="text-yellow-300" >Dir.:</span>  {{ $co->rem_dir  }}</p>
                    @endif
                </td>
                <td class="px-3 py-2" data-label="Turnado a">
                    @if(!empty($co->tur_nom))
                    <p> <span class="text-yellow-300" >nombre: </span> {{ $co->tur_nom  }}</p>
                    @endif
                    @if(!empty($co->tur_cargo))
                    <p> <span class="text-yellow-300" >Cargo: </span> {{ $co->tur_cargo  }}</p>
                    @endif
                    @if(!empty($co->tur_deporg))
                    <p> <span class="text-yellow-300" >Dep. Org.: </span> {{ $co->tur_deporg  }}</p>
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
                        <x-icon-action variant="info" icon="fa-regular fa-eye" :href="route('rg.show', $co->id)"
                            label="Ver detalles" />

                        <x-icon-action variant="warning" icon="fa-solid fa-pencil" :href="route('rg.edit', $co->id)"
                            label="Editar registro" />

                        <x-icon-action variant="report" icon="fa-regular fa-rectangle-list" href="javascript:void(0)"
                            wire:click="generarReporte({{ $co->id }}, 'reporte1')" label="Generar reporte normal" />

                        <x-icon-action variant="report" icon="fa-solid fa-bars" href="javascript:void(0)"
                            wire:click="generarReporte({{ $co->id }}, 'reporte2')" label="Generar reporte especial" />

                        <x-icon-action variant="report" icon="fa-solid fa-list" href="javascript:void(0)"
                            wire:click="generarReporte({{ $co->id }}, 'reporte3')" label="Generar reporte de solicitud" />
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
    </script>




</div> {{--  final de componente    --}}
