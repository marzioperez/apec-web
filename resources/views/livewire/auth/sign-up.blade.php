<div class="bg-white sm:py-20 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-{$current_step}.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <x-steps :quantity="2" :current="$current_step" :complete="$complete_step" />
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                @if($current_step == 1)
                    <p>Thank you for expressing your interest in attending the <b>APEC CEO Summit 2024</b>. To give you the best experience possible, we need you to complete a pre-registration.</p>
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
                            <label for="business">Business*</label>
                            <div class="form-field">
                                <input type="text" id="business" name="business" wire:model="business" />
                                @error('business') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="economy">Economy*</label>
                            <div class="form-field">
                                <input type="text" id="economy" name="economy" wire:model="economy" />
                                @error('economy') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_description">Business Description*</label>
                            <div class="form-field">
                                <input type="text" id="business_description" name="business_description" wire:model="business_description" />
                                @error('business_description') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Role*</label>
                            <div class="form-field">
                                <input type="text" id="role" name="role" wire:model="role" />
                                @error('role') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="biography">Biography*</label>
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
                            <a href="#" class="btn btn-primary-outline">Return</a>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>

                        <div class="flex justify-center">
                            <p>Have you already registered? <a href="#" class="text-blue">Log in</a></p>
                        </div>
                    </form>
                </div>
                @endif

                @if($current_step == 2)
                    <div class="my-8 px-5">
                        <h5 class="font-semibold mb-5">Participant's information (optional)</h5>
                        <form wire:submit.prevent="process_step_2">
                            <div class="form-group">
                                <label for="attendee_name">Attendee Name</label>
                                <div class="form-field">
                                    <input type="text" id="attendee_name" name="attendee_name" wire:model="attendee_name" />
                                    @error('attendee_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="attendee_email">Attendee Email</label>
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
                                        <label for="send_copy_of_registration" class="text-gray">Send Copy of Registration</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-span-4"></div>
                                <div class="form-field">
                                    <div class="form-check">
                                        <input type="checkbox" name="accept_terms_and_conditions" class="form-check-input" id="accept_terms_and_conditions" wire:model="accept_terms_and_conditions">
                                        <label for="accept_terms_and_conditions" class="text-gray">I accept the <a href="#" class="text-blue underline" target="_blank">Terms and Conditions</a></label>
                                    </div>
                                    @error('accept_terms_and_conditions') <span class="validation-error checkbox">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mt-14 mb-6 flex justify-center space-x-6 items-center">
                                <a href="#" class="btn btn-primary-outline">Return</a>
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
