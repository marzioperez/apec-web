<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-3.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="$complete" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Company information</h5>
                    <form wire:submit.prevent="process">
                        <div class="form-group">
                            <label for="business">Company/Organization*</label>
                            <div class="form-field">
                                <input type="text" id="business" name="business" value="{{$user['business']}}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Position*</label>
                            <div class="form-field">
                                <input type="text" id="role" name="role" value="{{$user['role']}}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area">Area/Department*</label>
                            <div class="form-field">
                                <input type="text" id="area" name="area" wire:model="data.area" :disabled="{{$lock_fields}}" />
                                @error('data.area') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <div class="form-field">
                                <input type="text" id="address" name="address" wire:model="data.address" :disabled="{{$lock_fields}}" />
                                @error('data.address') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city">City*</label>
                            <div class="form-field">
                                <input type="text" id="city" name="city" wire:model="data.city" :disabled="{{$lock_fields}}" />
                                @error('data.city') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Zip Code*</label>
                            <div class="form-field">
                                <input type="text" id="zip_code" name="zip_code" wire:model="data.zip_code" :disabled="{{$lock_fields}}" />
                                @error('data.city') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_phone_number">Telephone*</label>
                            <div class="form-field">
                                <input type="text" id="business_phone_number" name="business_phone_number" wire:model="data.business_phone_number" :disabled="{{$lock_fields}}" />
                                @error('data.business_phone_number') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="business_email">Email*</label>
                            <div class="form-field">
                                <input type="email" id="business_email" name="business_email" wire:model="data.business_email" :disabled="{{$lock_fields}}" />
                                @error('data.business_email') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="economy">Economy*</label>
                            <div class="form-field">
                                <select id="economy" name="economy" wire:model.live="data.economy" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    @foreach($economies as $economy)
                                        <option value="{{$economy['id']}}">{{$economy['name']}}</option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                                @error('data.economy') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if($data['economy'] === 'other')
                            <div class="form-group">
                                <label for="other_economy">Other economy</label>
                                <div class="form-field">
                                    <input type="text" id="other_economy" name="other_economy" wire:model="data.other_economy" :disabled="{{$lock_fields}}" />
                                    @error('data.other_economy') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif

                        <h5 class="font-semibold mt-10 mb-5">Assistant's Information</h5>
                        <div class="form-group">
                            <label for="attendee_name">Assistant's name</label>
                            <div class="form-field">
                                <input type="text" id="attendee_name" name="attendee_name" wire:model="data.attendee_name" :disabled="{{$lock_fields}}" />
                                @error('data.attendee_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="attendee_email">Assistant's email</label>
                            <div class="form-field">
                                <input type="text" id="attendee_email" name="attendee_email" wire:model="data.attendee_email" :disabled="{{$lock_fields}}" />
                                @error('data.attendee_email') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            @if($lock_fields)
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('update-step', {step: {{$current + 1}} })">Continue</button>
                            @else
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-gray" wire:click.prevent="save">Save</button>
                                <button type="submit" class="btn btn-primary">Continue</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
