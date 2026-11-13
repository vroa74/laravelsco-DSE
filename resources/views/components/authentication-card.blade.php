<div class="flex min-h-screen flex-col items-center justify-center px-4 py-8">
    <div class="mb-4">
        <img src="{{ asset('media/img/ple_legis_65.png') }}" alt="Escudo del Estado de Campeche"
            class="h-20 w-auto sm:h-24" />
    </div>

    <div
        class="w-full overflow-hidden rounded-xl border border-primary  p-5 shadow-modal sm:max-w-md sm:p-6  panel-base">
        {{ $slot }}
    </div>
</div>
