<div class="p-6 border-2 border-gray-200 rounded-xl flex items-center relative" wire:ignore
     x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('back'))]"
     x-on:start-scan.window="
        const reader = window.document.getElementById('reader');
        scanner = new QrScanner(reader,
            function (result) {
                if (result) {
                    $dispatch('process-qr', {code: result.data});
                    scanner.destroy();
                    scanner = null;
                }
            }, {
                onDecodeError: error => {},
                highlightScanRegion: true,
                highlightCodeOutline: true
            },
        );
        scanner.start()">
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

    <div class="relative">
        <div id="reader-container">
            <video id="reader"></video>
        </div>
    </div>
</div>
