<div x-data="{with_companion: '{{$with_companion}}', with_staff: '{{$with_staff}}' }"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-4.png")}}')">
    <x-steps :quantity="5" :current="3" :complete="2" />
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <p>We are committed to ensuring your experience is exceptional! Please inform us of any special requirements you may have.</p>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Special requirements</h5>
                    <form wire:submit.prevent="process">
                        <div class="form-group">
                            <label for="types_of_food">Types of food</label>
                            <div class="form-field">
                                <select id="types_of_food" name="types_of_food" wire:model="types_of_food">
                                    <option value="">Select...</option>
                                    <option value="Vegetarian">Vegetarian</option>
                                    <option value="Vegan">Vegan</option>
                                    <option value="Kosher">Kosher</option>
                                </select>
                                @error('types_of_food') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="require_special_assistance">Do you require any special assistance to participate?</label>
                            <div class="form-field">
                                <textarea id="require_special_assistance" name="require_special_assistance" wire:model="require_special_assistance"></textarea>
                                @error('require_special_assistance') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(in_array($this->user['type'], [
                            \App\Concerns\Enums\Types::PARTICIPANT->value,
                            \App\Concerns\Enums\Types::FREE_PASS_PARTICIPANT->value,
                            \App\Concerns\Enums\Types::VIP->value]))
                            <div class="form-group">
                                <label for="role">Will you attend the event with a companion?</label>
                                <div class="form-field flex space-x-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="with_companion_yes" name="with_companion" type="radio" wire:model="with_companion" value="yes" @change="with_companion = 'yes'" />
                                        <label for="with_companion_yes">Yes</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="with_companion_no" name="with_companion" type="radio" wire:model="with_companion" value="no" @change="with_companion = 'no'" />
                                        <label for="with_companion_no">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3" x-show="with_companion === 'yes'">
                                <h5 class="font-semibold mb-3">Companion information</h5>
                                <div class="form-group">
                                    <label for="companion.name">Name*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.name" name="name" wire:model="companion.name" />
                                        @error('companion.name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.last_name">Last Name(s)*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.last_name" name="companion.last_name" wire:model="companion.last_name" />
                                        @error('companion.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.phone">Phone Number*</label>
                                    <div class="form-field">
                                        <input type="text" id="companion.phone" name="companion.phone" wire:model="companion.phone" />
                                        @error('companion.phone') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companion.email">Email Address*</label>
                                    <div class="form-field">
                                        <input type="email" id="companion.email" name="companion.email" wire:model="companion.email" />
                                        @error('companion.email') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">Will you attend the event with a staff?</label>
                                <div class="form-field">
                                    <div class="form-field flex space-x-6">
                                        <div class="flex items-center gap-x-3">
                                            <input id="with_staff_yes" name="with_staff" type="radio" wire:model="with_staff" value="yes" @change="with_staff = 'yes'">
                                            <label for="with_staff_yes">Yes</label>
                                        </div>
                                        <div class="flex items-center gap-x-3">
                                            <input id="with_staff_no" name="with_staff" type="radio" wire:model="with_staff" value="no" @change="with_staff = 'no'">
                                            <label for="with_staff_no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3" x-show="with_staff === 'yes'">
                                <h5 class="font-semibold mb-3">Staff information</h5>
                                <div class="form-group">
                                    <label for="staff.name">Name*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.name" name="name" wire:model="staff.name" />
                                        @error('staff.name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.last_name">Last Name(s)*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.last_name" name="staff.last_name" wire:model="staff.last_name" />
                                        @error('staff.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.phone">Phone Number*</label>
                                    <div class="form-field">
                                        <input type="text" id="staff.phone" name="staff.phone" wire:model="staff.phone" />
                                        @error('staff.phone') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="staff.email">Email Address*</label>
                                    <div class="form-field">
                                        <input type="email" id="staff.email" name="staff.email" wire:model="staff.email" />
                                        @error('staff.email') <span class="validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            <button type="button" class="btn btn-gray" wire:click.prevent="save(false)">Save</button>
                            <button type="submit" class="btn btn-primary" wire:click.prevent="save(true)">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>