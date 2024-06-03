<div class="sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="w-full">
                <div class="sm:grid grid-cols-2 gap-10">
                    <div class="sm:mb-0 mb-6">
                        <div class="grid sm:grid-cols-3 grid-cols-2 gap-3">
                            @foreach($hotels as $hot)
                                <img src="{{url('storage/web/' . $hot['photo'])}}" class="w-full sm:mb-0 mb-5 cursor-pointer" x-on:click.prevent="$dispatch('show-hotel', {hotel: {{json_encode($hot)}} })">
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h3 class="text-primary-dark font-semibold mb-3 text-4xl uppercase">Welcome to Peru</h3>
                        <div class="my-8">
                            <h5 class="font-semibold mb-5 text-white">Hotel information</h5>
                            <form wire:submit.prevent="process" class="dark">
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_name">Hotel name*</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="hotel_name" name="hotel_name" wire:model="data.hotel_name" />
                                        @error('data.hotel_name') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_room">Room*</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="hotel_room" name="hotel_room" wire:model="data.hotel_room" />
                                        @error('data.hotel_room') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mt-5 mb-2">
                                    <h3 class="text-white font-semibold">Check-in information</h3>
                                </div>
                                <div class="sm:grid grid-cols-2 w-full">
                                    <div class="sm:grid grid-cols-12 mb-3">
                                        <div class="col-span-6 flex items-center">
                                            <label for="hotel_check_in_date">Date*</label>
                                        </div>
                                        <div class="form-field col-span-6 relative">
                                            <x-input.date wire:model.live="data.hotel_check_in_date" id="hotel_check_in_date" placeholder="dd/mm/yyyy" :options="['defaultDate' => $data['hotel_check_in_date']]"/>
                                            @error('data.hotel_check_in_date') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="sm:grid grid-cols-12 mb-3 sm:pl-6">
                                        <div class="col-span-3 flex items-center">
                                            <label for="hotel_check_in_hour">Hour*</label>
                                        </div>
                                        <div class="form-field col-span-9 relative">
                                            <x-input.date wire:model.live="data.hotel_check_in_hour" id="hotel_check_in_hour" placeholder="--:--" :options="['defaultDate' => $data['hotel_check_in_hour'], 'noCalendar' => true, 'enableTime' => true, 'dateFormat' => 'H:i', 'altFormat' => 'H:i']"/>
                                            @error('data.hotel_check_in_hour') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 mb-2">
                                    <h3 class="text-white font-semibold">Check-out information</h3>
                                </div>
                                <div class="sm:grid grid-cols-2 w-full">
                                    <div class="sm:grid grid-cols-12 mb-3">
                                        <div class="col-span-6 flex items-center">
                                            <label for="hotel_check_out_date">Date*</label>
                                        </div>
                                        <div class="form-field col-span-6 relative">
                                            <input type="date" id="hotel_check_out_date" name="hotel_check_out_date" wire:model="data.hotel_check_out_date" />
                                            @error('data.hotel_check_out_date') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="sm:grid grid-cols-12 mb-3 sm:pl-6">
                                        <div class="col-span-3 flex items-center">
                                            <label for="hotel_check_out_hour">Hour*</label>
                                        </div>
                                        <div class="form-field col-span-9 relative">
                                            <input type="time" id="hotel_check_out_hour" name="hotel_check_out_hour" wire:model="data.hotel_check_out_hour" />
                                            @error('data.hotel_check_out_hour') <span class="validation-error absolute right-3 -bottom-4 opacity-80">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:grid grid-cols-12 mt-9 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_details">Details</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <textarea id="hotel_details" name="hotel_details" wire:model="data.hotel_details"></textarea>
                                        @error('data.hotel_details') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                                    <button type="button" class="btn btn-secondary" wire:click="back">Return</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="modal-hotel" bg="black">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            @if($hotel)
                <div>
                    <div class="mb-3 sm:grid grid-cols-12">
                        <div class="col-span-full px-6 py-3">
                            <img src="{{url('storage/web/' . $hotel['photo'])}}" class="w-full">
                        </div>
                        <div class="col-span-full">
                            <h6 class="text-white font-semibold text-lg sm:text-start text-center">{{$hotel['name']}}</h6>
                        </div>
                        <div class="col-span-full">
                            @foreach(range(1, $hotel['stars'])  as $star)
                                <i class="fa-sharp fa-solid fa-star text-white text-sm"></i>
                            @endforeach
                        </div>
                        <div class="col-span-full mt-5 text-sm text-white">
                            {!! $hotel['description'] !!}
                        </div>
                        @if($hotel['social_networks'])
                            <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                @foreach($hotel['social_networks'] as $item)
                                    <a href="{{$item['data']['url']}}" target="_blank" class="btn-speaker-social">
                                        @if($item['type'] === 'linkedin')
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        @endif
                                        @if($item['type'] === 'facebook')
                                            <i class="fa-brands fa-facebook-f"></i>
                                        @endif
                                        @if($item['type'] === 'web')
                                            <i class="fa-light fa-globe"></i>
                                        @endif
                                        @if($item['type'] === 'instagram')
                                            <i class="fa-brands fa-instagram"></i>
                                        @endif
                                        @if($item['type'] === 'x')
                                            <i class="fa-brands fa-x-twitter"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </x-slot:body>
    </x-modal>
</div>
