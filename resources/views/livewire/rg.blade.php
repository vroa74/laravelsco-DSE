<div class="text-stone-200">


    <div id="accordion-collapse" class="text-center items-center w-full mx-auto">
        <h2 id="accordion-collapse-heading-1">
            <div class="relative">
                <div class="flex items-center justify-between w-full">
                    <!-- Botón Principal con el texto y el ícono SVG -->
                    <button
                        type="button"
                        class="flex items-center justify-between w-[100%] px-5 py-3 font-medium
                               text-gray-500 border border-gray-200 rounded-t-xl focus:ring-4 bg-blue-950 focus:ring-gray-200
                               dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-blue-800 gap-3"
                        wire:click="toggleAccordion"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="accordion-collapse-body-1">
                        <span>Filtros</span>

                        <svg
                            class="w-5 h-5 transition-transform {{ $isOpen ? 'rotate-180' : '' }}"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>

                    <!-- Contenedor de los botones adicionales centrados -->
                    <div class="flex gap-2 justify-center items-center absolute top-1/2 right-[50%] -translate-y-1/2">
                        <button wire:click="openInsertModal"

                                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                              <i class="fa-regular fa-square-plus"></i>
                          </span>
                        </button>


                        <button wire:click="exportPDF"
                                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                              <i class="fa-solid fa-file-export"></i>
                          </span>
                        </button>

                        <button wire:click="openViewQuery"
                                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                              <i class="fa-solid fa-filter"></i>
                          </span>
                        </button>
                    </div>
                </div>
            </div>
        </h2>

        <div id="accordion-collapse-body-1"
             class="{{ $isOpen ? '' : 'hidden' }} p-1 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            {{--      begin section containes filter--}}

                {{-------------------------------------------------------------------------------------------------------------------------------------------------------------------}}
                <div class="grid grid-cols-4 gap-1 w-full h-full px-4 ">
                    <div class="border-2 border-red-400 rounded-lg p-1 items-center text-center space-y-1">
                        {{-- inline-block se usa para un tamaño especifico           --}}
                        Mostrar:: <select
                            id="countries"
                            wire:model.live="NumPag"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 inline-block w-auto p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    <div class="border-2 border-blue-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                        {{-- Public folioinit, foliofin --}}
                        <div class="flex items-center space-x-1">
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
                    <div class="border-2 border-green-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                        <div class="flex items-center space-x-1">
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
                    <div class="border-2 border-yellow-400 rounded-lg p-1 text-center">
                        {{-- estatus --}}
                        <p>Total de registros: {{ $cos->total() }}</p>
                        <p>{{ $myquery }}</p>
                    </div>
                    {{--        fin filtro por estatus de la correspondencia ------------------------------------------------------}}
                    {{--         filtro por fechas ---------------------------------------------------------------------------}}
                    <div class="border-2 border-purple-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                        <div class="flex items-center space-x-2">
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
                        <div class="flex items-center space-x-2">
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
                        <div class="flex items-center space-x-2">
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
                    <div class="border-2 border-pink-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
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
                    <div class="border-2 border-teal-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
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
                    <div class="border-2 border-orange-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
                        <div class="flex items-center space-x-2 max-w-sm mx-auto">
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
                        <div class="flex items-center space-x-2 max-w-sm mx-auto">
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
                        <div class="flex items-center space-x-2 max-w-sm mx-auto">
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

    <div class=" pt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-xs text-center rtl:text-right bg-blue-900 text-gray-500 dark:text-gray-400 dark:hover:font-bold dark:hover:bg-blue-950"  >
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
                <th scope="col" class="px-6 py-3 w-[7%]">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach ($cos as $co)
                @if($co->estatus)
                       <tr class="bg-white border-b dark:bg-red-950 dark:border-red-800 hover:bg-gray-50 dark:hover:bg-red-900  dark:hover:text-base ">
                      @else
                      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600  dark:hover:text-black  dark:hover:text-base "  >
                @endif
                <td class="px-1 py-1">
                    {{$co->id}}
                </td>
                <td class="px-1 py-1">
                    {{ $co->legislatura  }}
                </td>
                <td class="px-1 py-1">
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
                <td class="px-1 py-1">

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
                <td class="px-1 py-1">
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
                <td class="px-1 py-1">
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
                <td class="px-1 py-1">
                    <p>{{ $co->des  }}</p>
                </td>
                <td class="px-1 py-1">
                    <p>{{ $co->seguimiento  }}</p>
                </td>
                <td class="px-1 py-1">
                    <button
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                           overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                           bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400
                           group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4
                           focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white
                            dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                             <i class="fa-regular fa-eye"></i> {{--  show record--}}
                        </span>
                    </button>{{--                    boton de show--}}

                    <button {{-- yellow-orange--}}
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                   overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                   bg-gradient-to-br from-yellow-200 to-red-700 group-hover:from-orange-500
                                   group-hover:to-orange-600 hover:text-white dark:text-white focus:ring-4
                                   focus:outline-none focus:ring-orange-600 dark:focus:ring-orange-800">

                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white
                                       dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-solid fa-pencil"></i>{{-- Edit--}}
                          </span>
                    </button> {{--                    boton de edit--}}
                    <a href="" wire:click="generarReporte({{ $co->id }}, 'reporte1')" target="_blank"
                            class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden
                                   text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br
                                   from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500
                                   hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200
                                   dark:focus:ring-purple-800">
                           <span class="relative px-2 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-regular fa-rectangle-list"></i>
                            </span>
                    </a>
                    <a href="" wire:click="generarReporte({{ $co->id }}, 'reporte2')" target="_blank"
                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden
                                   text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br
                                   from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500
                                   hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200
                                   dark:focus:ring-purple-800">
                           <span class="relative px-2 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-solid fa-bars"></i>
                            </span>
                    </a>
                    <a href="" wire:click="generarReporte({{ $co->id }}, 'reporte3')" target="_blank"
                          class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden
                                   text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br
                                   from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500
                                   hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200
                                   dark:focus:ring-purple-800">
                           <span class="relative px-2 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-solid fa-list"></i>
                            </span>
                    </a>

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
        window.addEventListener('reporteGenerado', event => {
            alert(event.detail.reporte);
        });

        window.addEventListener('reporteError', event => {
            alert(event.detail.mensaje);
        });
    </script>




</div> {{--  final de componente    --}}
