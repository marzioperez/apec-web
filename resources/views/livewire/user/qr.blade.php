<div class="sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="sm:py-32 py-12 flex justify-center">
            <div class="w-full">
                <div class="sm:grid grid-cols-2 gap-10">
                    <div class="sm:mb-0 mb-6">
                        <img src="{{asset('img/qr-banner.png')}}" class="w-full" />
                    </div>
                    <div>
                        <h3 class="text-primary-dark font-semibold mb-3 text-4xl uppercase">My QR</h3>
                        <p class="text-white mb-3">Kindly ensure to bring your passport with you for badge collection. <br>
                            Access all information related to the event using the QR code.</p>

                        <div class="my-8">
                            <img src="{{ config('app.url') . "/storage/qrs/{$user['qr']}" }}" class="rounded sm:w-[200px] w-full" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
