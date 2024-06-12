<div>
    <div class="relative" wire:ignore x-init="
        const scanner = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250
            },
            fps: 20,
        });
        scanner.render(success, error);

        function success(result) {
            Livewire.dispatch('process-qr', {code:result});
            scanner.clear();
        }

        function error(error) {
            console.log(error);
        }
    ">
        <div id="reader" width="100%" class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10"></div>
        <div id="result"></div>
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
    </div>

    <x-filament::modal id="user-data" icon="heroicon-o-user" width="xl" alignment="center">
        <x-slot name="heading">Información del asistente</x-slot>
        <x-slot name="description">
            @if($user)
                <p><b>Nombres y Apellidos:</b> {{$user['name']}} {{$user['last_name']}}</p>
                <p><b>Economía:</b> {{$user['rel_economy']['name']}}</p>
                <p style="margin-bottom: 20px;"><b>Tipo de usuario:</b> {{$user['type']}}</p>
            @endif
        </x-slot>
        <x-slot name="footerActions">

        </x-slot>
    </x-filament::modal>
    <script src="{{asset('js/html5-qrcode.min.js')}}" type="text/javascript"></script>
</div>
