<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catalogos
        </h2>
    </x-slot>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">--}}

    <div class="grid grid-cols-4 pt-4 gap-1 w-full h-full px-4 text-white ">
        <div class="border-2 border-red-950 rounded-lg p-1 items-center flex flex-col text-center space-y-1">
            @livewire('leg')

        </div>
        <div class="border-2 border-red-900 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
        @livewire('nc')
        </div>
        <div class="border-2 border-red-800 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
        @livewire('tc')
        </div>
        <div class="border-2 border-red-700 rounded-lg p-1 text-center  items-center  flex flex-col space-y-1">
            @livewire('cc')
        </div>
    </div>



{{--    --------------------------------------------------------------------------------------------------------------------------------}}
{{--    <div class="grid grid-cols-4 gap-1 w-full h-full px-4 text-white ">--}}
{{--        <div class="border-2 border-red-400 rounded-lg p-1 items-center  text-center space-y-1">--}}
{{--            --}}{{-- inline-block se usa para un tamaño especifico           --}}
{{--            Mostrar:: <select--}}
{{--                id="countries"--}}
{{--                wire:model.live="NumPag"--}}
{{--                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 inline-block w-auto p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                <option value="10" selected>Registros a mostrar</option>--}}
{{--                <option value="10">10</option>--}}
{{--                <option value="20">20</option>--}}
{{--                <option value="50">50</option>--}}
{{--                <option value="100">100</option>--}}
{{--                <option value="200">200</option>--}}
{{--                <option value="500">500</option>--}}
{{--                <option value="1000">1000</option>--}}
{{--            </select> Registros.--}}
{{--        </div>--}}
{{--        --}}{{--   fin  numero de registros a mostrar----------------------------------------------------}}
{{--        --}}{{--            filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
{{--        <div class="border-2 border-blue-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            --}}{{-- Public folioinit, foliofin --}}
{{--            <div class="flex items-center space-x-1">--}}
{{--                <span class="text-sm">Folio</span>--}}
{{--                <input type="number"--}}
{{--                       id="folio_init"--}}
{{--                       --}}{{--                                           wire:model.live="folioinit"--}}
{{--                       class="w-[100px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                <span class="text-sm">al</span>--}}
{{--                <input type="number"--}}
{{--                       id="folio_fin"--}}
{{--                       --}}{{--                                           wire:model.live="foliofin"--}}
{{--                       class="w-[100px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        --}}{{--           fin filtrar por id y por folio ya sea un registro o por un intervalo --------------------------------------------------------}}
{{--        --}}{{--        filtro por descripcion u por seguimiento -----------------------------------------------------------}}
{{--        <div class="border-2 border-green-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            <div class="flex items-center space-x-1">--}}
{{--                <span class="text-sm">Des.</span>--}}
{{--                <input type="text"--}}
{{--                       id="des"--}}
{{--                       --}}{{--                                           wire:model.live="des"--}}
{{--                       class="w-[80px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                <span class="text-sm">Seg.</span>--}}
{{--                <input type="text"--}}
{{--                       id="seg"--}}
{{--                       --}}{{--                                           wire:model.live="seg"--}}
{{--                       class="w-[80px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        --}}{{--        fin filtro por descripcion u por seguimiento -----------------------------------------------------------}}
{{--        --}}{{--        filtro por estatus de la correspondencia ------------------------------------------------------}}
{{--        <div class="border-2 border-yellow-400 rounded-lg p-1 text-center">--}}
{{--            --}}{{-- estatus --}}
{{--            --}}{{--                                <p>Total de registros: {{ $cos->total() }}</p>--}}
{{--            --}}{{--                                <p>{{ $myquery }}</p>--}}
{{--        </div>--}}
{{--        --}}{{--        fin filtro por estatus de la correspondencia ------------------------------------------------------}}
{{--        --}}{{--         filtro por fechas ---------------------------------------------------------------------------}}
{{--        <div class="border-2 border-purple-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            <div class="flex items-center space-x-2">--}}
{{--                <label for="fcapini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Cap.</label>--}}
{{--                <div class="relative">--}}
{{--                    <input--}}
{{--                        id="fcapini"--}}
{{--                        type="date"--}}
{{--                        --}}{{--                                            wire:model.live="fcapini"--}}
{{--                        class="bg-gray-800 border border-gray-600 text-white text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"--}}
{{--                        placeholder="YYYY/MM/DD"--}}
{{--                    />--}}
{{--                </div>--}}
{{--                <label for="fcapfin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>--}}
{{--                <div class="relative">--}}
{{--                    <input id="fcapfin"--}}
{{--                           type="date"--}}
{{--                           --}}{{--                                               wire:model.live="fcapfin"--}}
{{--                           data-date-format="yyyy/mm/dd"--}}
{{--                           placeholder="YYYY/MM/DD"--}}
{{--                           class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="flex items-center space-x-2">--}}
{{--                <label for="remcargoini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Rec</label>--}}
{{--                <div class="relative">--}}
{{--                    <input id="remcargoini"--}}
{{--                           type="date"--}}
{{--                           --}}{{--                                               wire:model.live="remcargoini"--}}
{{--                           class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">--}}
{{--                </div>--}}
{{--                <label for="remcargofin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>--}}
{{--                <div class="relative">--}}
{{--                    <input id="remcargofin"--}}
{{--                           type="date"--}}
{{--                           --}}{{--                           datepicker--}}
{{--                           --}}{{--                                               wire:model.live="remcargofin"--}}
{{--                           class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="flex items-center space-x-2">--}}
{{--                <label for="remdeporgini" class="text-xs font-medium text-gray-700 dark:text-gray-300">F. Ofi.</label>--}}
{{--                <div class="relative">--}}
{{--                    <input id="remdeporgini"--}}
{{--                           type="date"--}}
{{--                           --}}{{--                           datepicker--}}
{{--                           wire:model.live="remdeporgini"--}}
{{--                           class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">--}}
{{--                </div>--}}

{{--                <label for="remdeporgfin" class="text-xs font-medium text-gray-700 dark:text-gray-300">Al</label>--}}
{{--                <div class="relative">--}}
{{--                    <input id="remdeporgfin"--}}
{{--                           type="date"--}}
{{--                           --}}{{--                           datepicker--}}
{{--                           wire:model.live="remdeporgfin"--}}
{{--                           class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[100px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Date">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}{{--                                {{ $fcapini }} - {{ $fcapfin }}--}}
{{--        </div>--}}
{{--        --}}{{--       fin  filtro por fechas ---------------------------------------------------------------------------}}
{{--        --}}{{--            filtro por remitente ------------------------------------------------------}}
{{--        <div class="border-2 border-pink-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Rem. Nom.</span>--}}
{{--                <input type="text"--}}
{{--                       id="remnombre"--}}
{{--                       wire:model.live="remnombre"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Rem. Cargo</span>--}}
{{--                <input type="text"--}}
{{--                       id="remcargo"--}}
{{--                       wire:model.live="remcargo"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Rem. Dep.</span>--}}
{{--                <input type="text"--}}
{{--                       id="remdeporg"--}}
{{--                       wire:model.live="remdeporg"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        --}}{{--          fin  filtro por remitente ------------------------------------------------------}}
{{--        --}}{{--                filtro por elementos turnado -------------------------------------------------}}
{{--        <div class="border-2 border-teal-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Tur. Nom.</span>--}}
{{--                <input type="text"--}}
{{--                       id="turnom"--}}
{{--                       wire:model.live="turnom"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Tur. Car.</span>--}}
{{--                <input type="text"--}}
{{--                       id="turcargo"--}}
{{--                       wire:model.live="turcargo"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--            <div class="flex items-center p-0 space-x-1">--}}
{{--                <span class="text-sm">Tur. Dep.</span>--}}
{{--                <input type="text"--}}
{{--                       id="turdeporg"--}}
{{--                       wire:model.live="turdeporg"--}}
{{--                       class="w-[160px] p-1 text-gray-900 border border-gray-300 rounded-md bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        --}}{{--             fin   filtro por elementos turnado -------------------------------------------------}}
{{--        <div class="border-2 border-orange-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">--}}
{{--            <div class="flex items-center space-x-2 max-w-sm mx-auto">--}}
{{--                <!-- Label -->--}}
{{--                <label for="nnncor" class="text-xs font-medium text-gray-900 dark:text-white">N. Cor.</label>--}}
{{--                <!-- Select -->--}}
{{--                <select id="nnncor" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                    <option selected>Seleccione una opción</option>--}}
{{--                    <option value="US">United States</option>--}}
{{--                    <option value="CA">Canada</option>--}}
{{--                    <option value="FR">France</option>--}}
{{--                    <option value="DE">Germany</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="flex items-center space-x-2 max-w-sm mx-auto">--}}
{{--                <!-- Label -->--}}
{{--                <label for="tttcor" class="text-xs font-medium text-gray-900 dark:text-white">T. Cor.</label>--}}
{{--                <!-- Select -->--}}
{{--                <select id="tttcor" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                    <option selected>Choose</option>--}}
{{--                    <option value="US">United States</option>--}}
{{--                    <option value="CA">Canada</option>--}}
{{--                    <option value="FR">France</option>--}}
{{--                    <option value="DE">Germany</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="flex items-center space-x-2 max-w-sm mx-auto">--}}
{{--                <!-- Label -->--}}
{{--                <label for="cccor" class="text-xs font-medium text-gray-900 dark:text-white">Clas. Cor</label>--}}
{{--                <!-- Select -->--}}
{{--                <select id="cccor" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[120px] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                    <option selected>Choose</option>--}}
{{--                    <option value="US">United States</option>--}}
{{--                    <option value="CA">Canada</option>--}}
{{--                    <option value="FR">France</option>--}}
{{--                    <option value="DE">Germany</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
