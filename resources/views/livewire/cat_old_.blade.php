<div class="pt-4">
    <div class="grid grid-cols-4 pt-4 gap-1 w-full h-full px-4 text-white ">
        <div class="border-2 border-red-400 rounded-lg p-1 items-center  text-center space-y-1">
            <h3 class="text-center items-center">Legislatura</h3>
            <div class="flex items-center text-center space-x-4">
                <!-- Input con etiqueta en línea -->
                <label for="small-input" class="text-sm font-medium text-gray-900 dark:text-white">Legislatura</label>
                <input type="text" id="small-input" name="legislatura" wire:model="newLegislatura"
                       class="p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       style="width: 100px;">

                <!-- Botón -->
                <button wire:click="addLegislatura"
                        class="px-4 py-2 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Agregar
                </button>
            </div>

            <!-- Mensaje de confirmación -->
            @if(session()->has('message'))
                <div class="mt-2 text-green-500 text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <hr>

            <!-- Lista de legislaturas -->
            <ol>
                @foreach($legis as $item4)
                    <li>{{ $item4->legislatura }} - {{ $item4->actual }}</li>
                @endforeach
            </ol>

        </div>
        <div class="border-2 border-blue-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">
            <h3 class="text-center items-center"> Nivel de Correspondencia </h3>
            <div class="flex items-center space-x-4">
                <!-- Input con etiqueta en línea -->
                <label for="small-input" class="text-sm font-medium text-gray-900 dark:text-white">Nivel de Cor.</label>
                <input type="text" id="small-input" name="ncorx" class="p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="width: 100px;">

                <!-- Botón -->
                <button id="add-ncorx" class="px-4 py-2 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Agregar
                </button>
            </div>
            <hr/>
            <ol>
                @foreach($ncorss as $item3 )
                    <li> {{$item3->ncor }} </li>
                @endforeach
            </ol>

        </div>
        <div class="border-2 border-green-400 rounded-lg p-1 text-center flex flex-col items-center space-y-1">

            <hr>
            <ol>
                @foreach($tcorss as $item2 )
                <li> {{$item2->tcor }} </li>
                @endforeach
            </ol>
        </div>
        <div class="border-2 border-yellow-400 rounded-lg p-1 text-center">

            <hr>
            <ol>
                @foreach($ccorss as $item1)
                <li>{{$item1->tcor }}  - {{$item1->ccor }} </li>
                @endforeach
            </ol>
        </div>

    </div>

</div>
