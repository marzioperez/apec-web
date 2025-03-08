<footer class="relative z-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:grid grid-cols-12 gap-3">
            <div class="col-span-4 flex sm:justify-start justify-center sm:mb-0 mb-6">
                <img src="{{asset('img/logo-apec-white.svg')}}" class="h-[120px]">
            </div>
            <div class="col-span-4 flex justify-center items-center sm:mb-0 mb-6">
                <div class="w-full">
                    <div class="text-center mb-3">
                        <a href="{{route('faq')}}" class="btn btn-gray">FAQ</a>
                    </div>
                    <div class="text-center mb-2">
                        <a href="https://www.apec.org/" target="_blank" class="text-gray-300 text-sm underline">Asia-Pacific Economic Cooperation (APEC)</a>
                    </div>
                    <div class="text-center">
                        <a href="https://apecperu.pe/2024/en/" target="_blank" class="text-gray-300 text-sm underline">APEC Peru 2024</a>
                    </div>
                </div>
            </div>
            <div class="col-span-4 flex sm:justify-end justify-center items-center">
                <div>
                    @if(auth()->guest())
                        @if(request()->route()->uri !== "sign-up")
                            <div class="flex justify-center">
                                <a href="{{route('sign-up')}}" class="btn btn-secondary">Expression of interest</a>
                            </div>
                        @endif
                    @endif
                    <div class="flex justify-center space-x-3 sm:mt-5 mt-6">
                        <a href="https://www.facebook.com/APECCEOSummits?mibextid=ZbWKwL" target="_blank" class="social-icon">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/apec.ceosummit?igsh=Y3E1cnNpaTc2aWc5" target="_blank" class="social-icon">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/10664060" target="_blank" class="social-icon">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="https://x.com/APEC_CEOsummit" target="_blank" class="social-icon">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
