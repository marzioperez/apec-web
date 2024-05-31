<footer class="relative z-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:grid grid-cols-12 gap-3">
            <div class="col-span-4">
                <img src="{{asset('img/logo-color.png')}}">
            </div>
            <div class="col-span-4"></div>
            <div class="col-span-4 flex justify-end">
                <diV>
                    @if(auth()->guest())
                        <a href="{{route('sign-up')}}" class="btn btn-secondary">Expression of interest</a>
                    @endif
                    <div class="flex sm:justify-end justify-center space-x-3 mt-5">
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
