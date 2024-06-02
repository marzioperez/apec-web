<div class="sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="w-full">
                <div class="sm:grid grid-cols-2 gap-10">
                    <div class="sm:mb-0 mb-6">
                        <img src="{{asset('img/hotel-banner.png')}}" class="w-full" />
                    </div>
                    <div>
                        <h3 class="text-primary-dark font-semibold mb-3 text-4xl uppercase">Welcome to Peru</h3>
                        <div class="my-8">
                            <h5 class="font-semibold mb-5 text-white">Hotel information</h5>
                            <form wire:submit.prevent="process" class="dark">
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_name">Hotel name</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="hotel_name" name="hotel_name" wire:model="data.hotel_name" />
                                        @error('data.hotel_name') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_room">Room</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <input type="text" id="hotel_room" name="hotel_room" wire:model="data.hotel_room" />
                                        @error('data.hotel_room') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="sm:grid grid-cols-12 mb-3 relative">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_price">Price</label>
                                    </div>
                                    <div class="form-field col-span-9">
                                        <input type="text" id="hotel_price" name="hotel_price" wire:model="data.hotel_price" />
                                        @error('data.hotel_price') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="sm:grid grid-cols-12 mt-9 mb-3">
                                    <div class="col-span-3 flex items-center">
                                        <label for="hotel_conditions_and_payment">Conditions and payment</label>
                                    </div>
                                    <div class="form-field col-span-9 relative">
                                        <textarea id="hotel_conditions_and_payment" name="hotel_conditions_and_payment" wire:model="data.hotel_conditions_and_payment"></textarea>
                                        @error('data.hotel_conditions_and_payment') <span class="absolute right-3 bottom-3 opacity-80 validation-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                                    <button type="button" class="btn btn-secondary" wire:click.prevent="back">Return</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
