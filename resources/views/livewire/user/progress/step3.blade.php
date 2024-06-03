<div x-data="{
        with_companion: '{{$with_companion}}',
        with_staff: '{{$with_staff}}',
        current_user_step: {{$current_user_step}}
    }"
     x-on:update-user-step.window="current_user_step = $event.detail.step"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-4.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="$complete" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <p>We are committed to ensuring your experience is exceptional! Please inform us of any special requirements you may have.</p>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Special requirements</h5>
                    <form wire:submit.prevent="process">
                        <div class="form-group">
                            <label for="types_of_food">Dietary restrictions</label>
                            <div class="form-field">
                                <select id="types_of_food" name="types_of_food" wire:model="types_of_food" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    <option value="Vegetarian">Vegetarian</option>
                                    <option value="Vegan">Vegan</option>
                                    <option value="Kosher">Kosher</option>
                                </select>
                                @error('types_of_food') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="food_allergies">
                                Food allergies<br>Examples: Crustaceous, Nuts, others.
                            </label>
                            <div class="form-field">
                                <input type="text" id="food_allergies" name="food_allergies" wire:model="food_allergies" :disabled="{{$lock_fields}}" />
                                @error('food_allergies') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="require_special_assistance">Do you require any special assistance to participate?</label>
                            <div class="form-field flex space-x-6">
                                <div class="flex items-center gap-x-3">
                                    <input id="require_special_assistance_yes" name="require_special_assistance" type="radio" wire:model.live="require_special_assistance" value="yes" :disabled="{{$lock_fields}}" />
                                    <label for="require_special_assistance_yes">Yes</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input id="require_special_assistance_no" name="require_special_assistance" type="radio" wire:model.live="require_special_assistance" value="no" :disabled="{{$lock_fields}}" />
                                    <label for="require_special_assistance_no">No</label>
                                </div>
                            </div>
                        </div>

                        @if($require_special_assistance === 'yes')
                            <div class="form-group">
                                <label for="special_assistance_details">Details*</label>
                                <div class="form-field">
                                    <textarea name="special_assistance_details" wire:model="special_assistance_details" :disabled="{{$lock_fields}}"></textarea>
                                    @error('special_assistance_details') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif

                        @if(in_array($this->user['type'], [
                            \App\Concerns\Enums\Types::PARTICIPANT->value,
                            \App\Concerns\Enums\Types::FREE_PASS_PARTICIPANT->value,
                            \App\Concerns\Enums\Types::VIP->value]))

                            <div class="rounded-md bg-yellow-50 p-4" x-show="(with_companion === 'yes' || with_staff === 'yes') && current_user_step > 3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Important</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>By editing these fields, previous users and emails will no longer have access to the registration process</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">
                                    Will you bring your spouse / accompanying person?
                                    @if(!$user['companion_free'])
                                        (US$ {{number_format($user['companion_amount'])}})
                                    @endif
                                </label>
                                <div class="form-field flex space-x-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="with_companion_yes" name="with_companion" type="radio" wire:model="with_companion" value="yes" @change="with_companion = 'yes'" :disabled="{{$lock_fields}}" />
                                        <label for="with_companion_yes">Yes</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="with_companion_no" name="with_companion" type="radio" wire:model="with_companion" value="no" @change="with_companion = 'no'" :disabled="{{$lock_fields}}" />
                                        <label for="with_companion_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3" x-show="with_companion === 'yes'">
                                <h5 class="font-semibold mb-3">Companion information</h5>
                                <div class="form-group">
                                    <label for="companion.name">Name*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.name" name="name" wire:model="companion.name" :disabled="{{$lock_fields}}" />
                                        @error('companion.name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.last_name">Last Name(s)*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.last_name" name="companion.last_name" wire:model="companion.last_name" :disabled="{{$lock_fields}}" />
                                        @error('companion.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.phone">Phone Number*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.phone" name="companion.phone" wire:model="companion.phone" :disabled="{{$lock_fields}}" />
                                        @error('companion.phone') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.email">Email Address*</label>
                                    <div class="form-field">
                                        <input type="email" id="companion.email" name="companion.email" wire:model="companion.email" :disabled="{{$lock_fields}}" />
                                        @error('companion.email') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">
                                    Will you bring a staffer?
                                    @if(!$user['staff_free'])
                                        (US$ {{number_format($user['staff_amount'])}})
                                    @endif
                                </label>
                                <div class="form-field">
                                    <div class="form-field flex space-x-6">
                                        <div class="flex items-center gap-x-3">
                                            <input id="with_staff_yes" name="with_staff" type="radio" wire:model="with_staff" value="yes" @change="with_staff = 'yes'" :disabled="{{$lock_fields}}">
                                            <label for="with_staff_yes">Yes</label>
                                        </div>
                                        <div class="flex items-center gap-x-3">
                                            <input id="with_staff_no" name="with_staff" type="radio" wire:model="with_staff" value="no" @change="with_staff = 'no'" :disabled="{{$lock_fields}}">
                                            <label for="with_staff_no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3" x-show="with_staff === 'yes'">
                                <h5 class="font-semibold mb-3">Staffer information</h5>
                                <div class="form-group">
                                    <label for="staff.name">Name*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.name" name="name" wire:model="staff.name" :disabled="{{$lock_fields}}" />
                                        @error('staff.name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.last_name">Last Name(s)*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.last_name" name="staff.last_name" wire:model="staff.last_name" :disabled="{{$lock_fields}}" />
                                        @error('staff.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.phone">Phone Number*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.phone" name="staff.phone" wire:model="staff.phone" :disabled="{{$lock_fields}}" />
                                        @error('staff.phone') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.email">Email Address*</label>
                                    <div class="form-field">
                                        <input type="email" id="staff.email" name="staff.email" wire:model="staff.email" :disabled="{{$lock_fields}}" />
                                        @error('staff.email') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            @if($lock_fields)
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('update-step', {step: {{$current + 1}} })">Continue</button>
                            @else
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-gray" wire:click.prevent="save(false)">Save</button>
                                <button type="submit" class="btn btn-primary" wire:click.prevent="save(true)">Continue</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
