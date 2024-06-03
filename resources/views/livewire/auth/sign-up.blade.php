<div class="bg-white sm:py-20 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-{$current_step}.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <x-steps :quantity="2" :current="$current_step" :complete="$complete_step" />
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Expression of interest</h3>
                @if($current_step == 1)
                    <p>We appreciate your interest in attending the <b>APEC CEO Summit 2024</b>. In order to assess your application, we kindly request that you complete this form.</p>
                    <div class="my-8 px-5">
                        <h5 class="font-semibold mb-5">General information</h5>
                        <form wire:submit.prevent="process_step_1">
                            <div class="form-group">
                                <label for="name">Name(s)*</label>
                                <div class="form-field">
                                    <input type="text" id="name" name="name" wire:model="name" />
                                    @error('name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name(s)*</label>
                                <div class="form-field">
                                    <input type="text" id="last_name" name="last_name" wire:model="last_name" />
                                    @error('last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="business">Company/Organization*</label>
                                <div class="form-field">
                                    <input type="text" id="business" name="business" wire:model="business" />
                                    @error('business') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="business_description">Company/Organization description*</label>
                                <div class="form-field">
                                    <input type="text" id="business_description" name="business_description" wire:model="business_description" />
                                    @error('business_description') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="economy">Economy*</label>
                                <div class="form-field">
                                    <select id="economy" name="economy" wire:model.live="economy">
                                        <option value="">Select...</option>
                                        @foreach($economies as $ec)
                                            <option value="{{$ec['id']}}">{{$ec['name']}}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    @error('economy') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if($economy === 'other')
                                <div class="form-group">
                                    <label for="other_economy">Other economy*</label>
                                    <div class="form-field">
                                        <input type="text" id="other_economy" name="other_economy" wire:model="other_economy" />
                                        @error('other_economy') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="role">Position*</label>
                                <div class="form-field">
                                    <input type="text" id="role" name="role" wire:model="role" />
                                    @error('role') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="biography">Short bio*</label>
                                <div class="form-field">
                                    <textarea id="biography" name="biography" wire:model="biography"></textarea>
                                    @error('biography') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <div class="form-field">
                                    <input type="email" id="email" name="email" wire:model="email" />
                                    @error('email') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm_email">Confirm Email*</label>
                                <div class="form-field">
                                    <input type="email" id="confirm_email" name="confirm_email" wire:model="confirm_email" />
                                    @error('confirm_email') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number*</label>
                                <div class="form-field">
                                    <input type="text" id="phone_number" name="phone_number" wire:model="phone_number" />
                                    @error('phone_number') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                                <a href="{{config('app.url')}}" class="btn btn-primary-outline">Return</a>
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>

                            <div class="flex justify-center">
                                <p>Have you already registered? <a href="{{route('login')}}" class="text-blue">Log in</a></p>
                            </div>
                        </form>
                    </div>
                @endif

                @if($current_step == 2)
                    <div class="my-8 px-5">
                        <h5 class="font-semibold mb-5">Participant's information (optional)</h5>
                        <form wire:submit.prevent="process_step_2">
                            <div class="form-group">
                                <label for="attendee_name">Assistant's Name</label>
                                <div class="form-field">
                                    <input type="text" id="attendee_name" name="attendee_name" wire:model="attendee_name" />
                                    @error('attendee_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="attendee_email">Assistant's Email</label>
                                <div class="form-field">
                                    <input type="email" id="attendee_email" name="last_name" wire:model="attendee_email" />
                                    @error('attendee_email') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-span-4"></div>
                                <div class="form-field">
                                    <div class="form-check">
                                        <input type="checkbox" name="send_copy_of_registration" class="form-check-input" id="send_copy_of_registration" wire:model="send_copy_of_registration">
                                        <label for="send_copy_of_registration" class="text-gray">Send a copy of my registration</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-span-4"></div>
                                <div class="form-field">
                                    <div class="form-check">
                                        <input type="checkbox" name="accept_terms_and_conditions" class="form-check-input" id="accept_terms_and_conditions" wire:model="accept_terms_and_conditions">
                                        <label for="accept_terms_and_conditions" class="text-gray">I accept the <a href="{{route('page', ['slug' => 'terms-and-conditions'])}}" class="text-blue underline pl-1" target="_blank">Terms and Conditions</a></label>
                                    </div>
                                    @error('accept_terms_and_conditions') <span class="validation-error checkbox">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mt-14 mb-6 flex justify-center space-x-6 items-center">
                                <a href="{{config('app.url')}}" class="btn btn-primary-outline">Return</a>
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-modal name="modal-status-ok">
        <x-slot:body>
            <div class="flex justify-center mb-3">
                <svg width="62" height="62" viewBox="0 0 82 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="13" y="15" width="46" height="42" fill="white"/>
                    <path d="M41 0C18.3563 0 0 18.3563 0 41C0 63.6437 18.3563 82 41 82C63.6437 82 82 63.6437 82 41C82 18.3563 63.6437 0 41 0ZM58.5921 19.2037L67.1104 27.722L40.5045 54.3331L32.0362 62.7963L23.5179 54.278L14.8895 45.6445L23.3528 37.1812L31.9812 45.8146L58.5921 19.2037Z" fill="#009600"/>
                </svg>
            </div>
            <div class="text-center">
                <h1 class="font-bold text-lg mb-3">Thank you for your interest in attending the APEC CEO Summit 2024.</h1>
                <div class="mb-5">Please check your inbox for a confirmation of your expression of interest in this event.</div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Back home</a>
            </div>
        </x-slot:body>
    </x-modal>
</div>
