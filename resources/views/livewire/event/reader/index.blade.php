<div>
    <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-sm: repeat(3, minmax(0, 1fr)); --cols-xl: repeat(2, minmax(0, 1fr)); --cols-2xl: repeat(2, minmax(0, 1fr));"
         class="grid grid-cols-[--cols-default] sm:grid-cols-[--cols-sm] xl:grid-cols-[--cols-xl] 2xl:grid-cols-[--cols-2xl] fi-fo-component-ctn gap-6">
        <div>
            <livewire:event.reader.search-by-document />
        </div>
        <div class="p-6 border-2 border-gray-200 rounded-xl flex items-center relative">
            <form class="w-full py-6 px-10 block" wire:submit.prevent="process_document_number">
                <div class="grid gap-y-2 pb-4">
                    <p class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                        <span class="text-sm text-center w-full font-medium leading-6 text-gray-950 dark:text-white">Scanear con código QR</span>
                    </p>
                </div>
                <button type="button" x-on:click.prevent="$dispatch('start-scan'); $dispatch('open-modal', {id: 'modal-qr'})"
                    style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                    class="fi-btn mx-auto relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm block shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Empezar</button>
            </form>
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
                <button wire:click.prevent="confirm_user" type="button" style="margin-bottom: 30px; --c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn mx-auto relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm block shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Acreditar</button>
            @endif
        </x-slot>
    </x-filament::modal>

    <x-filament::modal id="modal-qr" width="xl" alignment="center">
        <x-slot name="heading">Scanear código QR</x-slot>
        <x-slot name="description">
            <livewire:event.reader.qr-reader />
        </x-slot>
    </x-filament::modal>

    <x-filament::modal id="modal-error" icon="heroicon-o-x-circle" width="xl" alignment="center">
        <x-slot name="heading">Ocurrió un error</x-slot>
        <x-slot name="description">
            <div style="padding-bottom: 25px;">
                {{$error_message}}
            </div>
        </x-slot>
    </x-filament::modal>
</div>
