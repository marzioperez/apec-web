<div class="bg-white sm:py-20 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-1.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">

        <div class="py-10 flex justify-center">
            <div class="sm:w-[550px] w-full">
                <h3 class="text-primary-dark font-semibold mb-6 text-2xl">Log in</h3>
                <form wire:submit.prevent="process">
                    <div class="form-group inline-fields">
                        <label for="email" class="uppercase">Email*</label>
                        <div class="form-field">
                            <input type="email" id="email" name="email" wire:model="email" />
                            @error('email') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group inline-fields">
                        <label for="password" class="uppercase">Password*</label>
                        <div class="form-field">
                            <input type="password" id="password" name="password" wire:model="password" />
                            @error('password') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="sm:grid flex items-center justify-center space-x-5 grid-cols-2 gap-3">
                        <div class="form-check">
                            <input type="checkbox" name="remember_me" class="form-check-input" id="remember_me" wire:model="remember_me">
                            <label for="remember_me" class="text-gray">Remember me</label>
                        </div>
                        <div class="flex sm:justify-end"><a href="#" class="text-blue-light text-sm">Forgot your password?</a></div>
                    </div>
                    <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-modal name="modal-status-error">
        <x-slot:body>
            <button type="button" class="absolute z-30 top-3 right-3" x-data x-on:click="$dispatch('close-modal')">
                <svg class="fill-gray-400" height="10px" width="10px" viewBox="0 0 460.775 460.775" xml:space="preserve">
                    <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
	c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
	c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
	c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
	l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
	c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/>
                </svg>
            </button>
            <div class="flex justify-center mb-3">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25 0C20.0555 0 15.222 1.46622 11.1108 4.21326C6.99952 6.96029 3.79521 10.8648 1.90302 15.4329C0.0108321 20.0011 -0.484251 25.0277 0.480379 29.8772C1.44501 34.7268 3.82603 39.1813 7.32234 42.6777C10.8186 46.174 15.2732 48.555 20.1227 49.5196C24.9723 50.4842 29.9989 49.9892 34.5671 48.097C39.1352 46.2048 43.0397 43.0005 45.7867 38.8892C48.5338 34.778 50 29.9445 50 25C50 21.7169 49.3533 18.466 48.097 15.4329C46.8406 12.3998 44.9991 9.64379 42.6777 7.32233C40.3562 5.00086 37.6002 3.15938 34.5671 1.90301C31.5339 0.646644 28.283 0 25 0ZM31.775 28.225C32.0093 28.4574 32.1953 28.7339 32.3222 29.0385C32.4491 29.3432 32.5145 29.67 32.5145 30C32.5145 30.33 32.4491 30.6568 32.3222 30.9614C32.1953 31.2661 32.0093 31.5426 31.775 31.775C31.5426 32.0093 31.2661 32.1953 30.9614 32.3222C30.6568 32.4491 30.33 32.5145 30 32.5145C29.67 32.5145 29.3432 32.4491 29.0386 32.3222C28.7339 32.1953 28.4574 32.0093 28.225 31.775L25 28.525L21.775 31.775C21.5426 32.0093 21.2661 32.1953 20.9614 32.3222C20.6568 32.4491 20.33 32.5145 20 32.5145C19.67 32.5145 19.3432 32.4491 19.0386 32.3222C18.7339 32.1953 18.4574 32.0093 18.225 31.775C17.9907 31.5426 17.8047 31.2661 17.6778 30.9614C17.5509 30.6568 17.4855 30.33 17.4855 30C17.4855 29.67 17.5509 29.3432 17.6778 29.0385C17.8047 28.7339 17.9907 28.4574 18.225 28.225L21.475 25L18.225 21.775C17.7542 21.3042 17.4898 20.6657 17.4898 20C17.4898 19.3342 17.7542 18.6958 18.225 18.225C18.6958 17.7542 19.3342 17.4898 20 17.4898C20.6658 17.4898 21.3042 17.7542 21.775 18.225L25 21.475L28.225 18.225C28.6958 17.7542 29.3342 17.4898 30 17.4898C30.6658 17.4898 31.3042 17.7542 31.775 18.225C32.2458 18.6958 32.5102 19.3342 32.5102 20C32.5102 20.6657 32.2458 21.3042 31.775 21.775L28.525 25L31.775 28.225Z" fill="#DB2828"/>
                </svg>
            </div>
            <div class="text-center">
                <h1 class="font-bold text-lg mb-3">Your data is incorrect</h1>
                <div class="mb-5">Please try again or recover it now if you've forgotten.</div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Recover password</a>
            </div>
        </x-slot:body>
    </x-modal>
</div>
