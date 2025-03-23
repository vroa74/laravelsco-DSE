<div>
    <h3>Clasificación de Correspondencia</h3>
    <div class="flex justify-center text-xs items-center pt-1">
        <label for="nncc" class="text-sm font-medium text-gray-900 dark:text-white">Niv. Cor.</label>
        <select id="nncc"
                wire:change="miFuncionPersonalizada($event.target.value)"
                class="bg-gray-50 border text-xs border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="0" selected>Seleccione una opción</option>
            @foreach($tcc as $items)
                <option value="{{ $items->id }}">{{ $items->tcor }}</option>
            @endforeach
        </select>
    </div>

    <!-- Mostrar los valores de ncor y ccor -->
    <div class="pt-2">
        @if($tccc && $tccctxt)
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">NCOR: {{ $tccc }}</p>
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">CCOR: {{ $tccctxt }}</p>
        @endif
    </div>
{{--    <p> {{$nccc}} - {{$ncccid}}</p>  ++++--}}

    <div class="flex justify-center items-center pt-2 pb-2 ">
        <div class="flex items-center space-x-2">
            <input type="text"
                   id="ncs"
                   class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                           overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                           bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400
                           group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4
                           focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white
                            dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                <i class="fa-solid fa-notes-medical"></i> {{--  add record--}}
                </span>
            </button>

        </div>
    </div>

    <hr>
    <ol class="list-none list-inside text-xs pt-2">
        @foreach($ccc as $items)
            <li class="flex justify-between items-center">
                <span>-  {{ $items->tcor }}  --  {{ $items->ccor }}   </span>
                <div>

                    <button wire:click="startEdit({{ $items->id }})" {{-- yellow-orange--}}
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                   overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                   bg-gradient-to-br from-yellow-200 to-red-700 group-hover:from-orange-500
                                   group-hover:to-orange-600 hover:text-white dark:text-white focus:ring-4
                                   focus:outline-none focus:ring-orange-600 dark:focus:ring-orange-800">

                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white
                                       dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-solid fa-pencil"></i>{{-- Edit--}}
                          </span>
                    </button>
                    <button wire:click="deleteCcor({{ $items->id }})"  {{-- red-orange--}}
                    class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2
                                   overflow-hidden text-sm font-medium text-gray-900 rounded-lg group
                                   bg-gradient-to-br from-orange-400 to-red-800 group-hover:from-red-600
                                   group-hover:to-orange-800 hover:text-white dark:text-white focus:ring-4
                                   focus:outline-none focus:ring-red-200 dark:focus:ring-red-800">
                          <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white
                                       dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            <i class="fa-solid fa-trash-can"></i>{{-- borrar--}}
                          </span>
                    </button>


                </div>
            </li>
        @endforeach
    </ol>

</div>
