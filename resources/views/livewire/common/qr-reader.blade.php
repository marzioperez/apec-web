<div class="!text-white mt-12 px-12">
    <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-sm: repeat(3, minmax(0, 1fr)); --cols-xl: repeat(12, minmax(0, 1fr)); --cols-2xl: repeat(12, minmax(0, 1fr));"
        class="grid grid-cols-[--cols-default] sm:grid-cols-[--cols-sm] xl:grid-cols-[--cols-xl] 2xl:grid-cols-[--cols-2xl] fi-fo-component-ctn gap-6">
        <div style="--col-span-default: span 6 / span 6; border-style: dashed;"
             class="col-[--col-span-default] p-6 border-2 border-gray-200 rounded-xl flex items-center">
            <form class="w-full px-10" wire:submit.prevent="process_document_number">
                <div class="grid gap-y-2 pb-4">
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                        <span class="text-sm text-center w-full font-medium leading-6 text-gray-950 dark:text-white">Buscar por número de documento</span>
                    </label>
                    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                        <input type="text" class="fi-input block w-full text-center border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3 mb-3" wire:model="document_number" />
                    </div>
                </div>
                <button type="submit"
                    style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                    class="fi-btn mx-auto relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm block shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Consultar</button>
            </form>
        </div>
        <div style="--col-span-default: span 6 / span 6; border-style: dashed;"
             class="col-[--col-span-default] p-6 border-2 dark:border-gray/5 border-gray rounded-xl flex items-center">
            <div class="relative" wire:ignore x-init="
                const reader = window.document.getElementById('reader');
                const qrScanner = new QrScanner(reader,
                    function (result) {
                        if (result) {
                            console.log(result);
                            this.stop();
                        }
                    }, {
                        onDecodeError: error => {},
                        highlightScanRegion: true,
                        highlightCodeOutline: true
                    },
                );
                qrScanner.start();
            ">
                <div id="reader-container">
                    <video id="reader"></video>
                </div>
            </div>
        </div>
    </div>


    <div wire:loading>
        <div class="loader">
            <div class="typewriter">
                <div class="slide"><i></i></div>
                <div class="paper"></div>
                <div class="keyboard"></div>
                <div class="loader-text">Cargando...</div>
            </div>
        </div>
    </div>

    <x-filament::modal id="user-data" icon="heroicon-o-user" width="xl" alignment="center">
        <x-slot name="heading">Información del asistente</x-slot>
        <x-slot name="description">
            @if($user)
                <p><b>Nombres y Apellidos:</b> {{$user['name']}} {{$user['last_name']}}</p>
                <p><b>Documento de identidad:</b> {{$user['document_number']}}</p>
                <p><b>Economía:</b> {{$user['rel_economy']['name']}}</p>
                <p style="margin-bottom: 20px;"><b>Categoría:</b> {{$user['type']}}</p>
            @endif
        </x-slot>
        <x-slot name="footerActions">

        </x-slot>
    </x-filament::modal>
</div>
