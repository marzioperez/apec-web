<div>

    <div class="w-full grid grid-cols-2 gap-10 p-10">
        <div class="p-3 rounded-lg bg-white shadow">
            <livewire:auth.register />
        </div>
        <div class="p-3 rounded-lg bg-white shadow flex items-center justify-center">
            <div>
                <p class="text-center mb-3">Aquí aparecerá tu código QR</p>
                @if($qr_code)
                    <img src="{{asset($qr_code)}}" class="block mx-auto" />
                @endif
            </div>
        </div>
    </div>

</div>
