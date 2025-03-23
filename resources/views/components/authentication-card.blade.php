<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 pb-0 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div>
        <img src="{{ asset('media/img/logos.png') }}" alt=""  height="150px"  width="150px" />
    </div>

    <div class="w-full sm:max-w-md mt-6 px-2 py-2 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
