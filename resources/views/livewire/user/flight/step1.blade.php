<div class="sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="w-full">
                <div class="sm:grid grid-cols-12 gap-10">
                    <div class="sm:mb-0 mb-6 lg:col-span-6 col-span-full">
                        <img src="{{asset('img/flight-banner.png')}}" class="w-full" />
                    </div>
                    <div class="lg:col-span-6 col-span-full">
                        <h3 class="text-primary-dark font-semibold mb-3 text-4xl uppercase">Welcome to Peru</h3>
                        <p class="text-white mb-3">To ensure a perfect experience upon arrival in Lima, Peru, we are pleased to offer you an offer of personalized transfers and accompaniment during your stay.</p>
                        <p class="text-white">If you wish to avail of these services, please provide your flight and accommodation details.</p>
                        <div class="my-8">
                            <h5 class="font-semibold mb-5 text-white">Arrival flight information</h5>
                            <form wire:submit.prevent="process" class="dark">
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="arrived_air_line">Airline name</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="arrived_air_line" name="arrived_air_line" wire:model="data.arrived_air_line" />
                                        @error('data.arrived_air_line') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="arrived_origin">Origin</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="arrived_origin" name="arrived_origin" wire:model="data.arrived_origin" />
                                        @error('data.arrived_origin') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3 relative">
                                    <div class="col-span-3 flex items-center">
                                        <label for="arrived_flight_number">Flight number</label>
                                    </div>
                                    <div class="form-field col-span-9">
                                        <input type="text" id="arrived_flight_number" name="arrived_flight_number" wire:model="data.arrived_flight_number" />
                                        @error('data.arrived_flight_number') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-2 w-full sm:mb-0 mb-9">
                                    <div class="sm:grid grid-cols-12 mb-3">
                                        <div class="col-span-6 flex items-center">
                                            <label for="arrived_date">Date</label>
                                        </div>
                                        <div class="form-field col-span-6 relative">
                                            <x-input.date wire:model.live="data.arrived_date" id="arrived_date" placeholder="dd/mm/yyyy" :options="['defaultDate' => $data['arrived_date']]"/>
                                            @error('data.arrived_date') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="sm:grid grid-cols-12 mb-3 sm:pl-6">
                                        <div class="col-span-3 flex items-center">
                                            <label for="arrived_time">Hour</label>
                                        </div>
                                        <div class="form-field col-span-9 relative">
                                            <input type="time" id="arrived_time" name="arrived_time" wire:model="data.arrived_time" />
                                            @error('data.arrived_time') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <h5 class="font-semibold mt-3 mb-5 text-white">Departure flight information</h5>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="exit_air_line">Airline name</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="exit_air_line" name="exit_air_line" wire:model="data.exit_air_line" />
                                        @error('data.exit_air_line') <span class="validation-error absolute right-3 bottom-3 opacity-80 ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="exit_destination">Destination</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="exit_destination" name="exit_destination" wire:model="data.exit_destination" />
                                        @error('data.exit_destination') <span class="validation-error absolute right-3 bottom-3 opacity-80 ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="exit_flight_number">Flight number</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="exit_flight_number" name="exit_flight_number" wire:model="data.exit_flight_number" />
                                        @error('data.exit_flight_number') <span class="validation-error absolute right-3 bottom-3 opacity-80 ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-2 w-full">
                                    <div class="sm:grid grid-cols-12 mb-3">
                                        <div class="col-span-6 flex items-center">
                                            <label for="exit_date">Date</label>
                                        </div>
                                        <div class="form-field col-span-6 relative">
                                            <x-input.date wire:model.live="data.exit_date" id="exit_date" placeholder="dd/mm/yyyy" :options="['defaultDate' => $data['exit_date']]"/>
                                            @error('data.exit_date') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="sm:grid grid-cols-12 mb-3 sm:pl-6">
                                        <div class="col-span-3 flex items-center">
                                            <label for="exit_time">Hour</label>
                                        </div>
                                        <div class="form-field col-span-9 relative">
                                            <input type="time" id="exit_time" name="exit_time" wire:model="data.exit_time" />
                                            @error('data.exit_time') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid grid-cols-12 mt-9 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="flight_contact_number">Contact number</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="flight_contact_number" name="flight_contact_number" wire:model="data.flight_contact_number" />
                                        @error('data.flight_contact_number') <span class="absolute right-3 bottom-3 opacity-80  validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="sm:grid grid-cols-12 mt-9 mb-3">
                                    <div class="col-span-6 flex items-center">
                                        <label for="flight_contact_number">
                                            Free transportation from airport to hotel?<br>
                                            <div class="text-white/80 text-xs">*Transportation service starting from November 9<sup>th</sup>.</div>
                                        </label>
                                    </div>
                                    <div class="form-field col-span-6 flex space-x-6">
                                        <div class="flex items-center gap-x-3">
                                            <input id="flight_free_transportation_yes" name="flight_free_transportation" type="radio" wire:model.live="data.flight_free_transportation" value="yes" />
                                            <label for="flight_free_transportation_yes">Yes</label>
                                        </div>
                                        <div class="flex items-center gap-x-3">
                                            <input id="flight_free_transportation_no" name="flight_free_transportation" type="radio" wire:model.live="data.flight_free_transportation" value="no" />
                                            <label for="flight_free_transportation_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                @if($data['flight_free_transportation'] === 'yes')
                                    <div class="sm:grid grid-cols-12 mt-9 mb-3">
                                        <div class="col-span-3 flex items-center">
                                            <label for="flight_contact_number">Details*</label>
                                        </div>
                                        <div class="form-field col-span-9">
                                            <textarea id="flight_details" name="flight_details" wire:model="data.flight_details"></textarea>
                                            @error('data.flight_details') <span class="validation-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                                    <button type="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
