<div x-data="{
        badge_name: '{{$badge_name}}',
        badge_last_name: '{{$badge_last_name}}'
    }"
     x-on:upload-photo.window="console.log('olaa')"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <p>Información de Badge - Revisión<br>
                    Your badge serves as your access pass to the APEC CEO Summit. Please help us in ensuring it looks great!</p>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Badge information</h5>
                    <form wire:submit.prevent="process">
                        <div class="badge">
                            <div class="flex justify-end">
                                <img src="{{asset('img/logo.png')}}" class="h-16" />
                            </div>
                            <div class="sm:grid grid-cols-12 gap-6 -mt-4">
                                <div class="col-span-4">
                                    @if($badge_photo)
                                        @if(count($badge_photo) > 0)
                                            <img src="{{ $badge_photo[0]['temporaryUrl'] }}" class="object-fill w-full h-full" alt="{{ $badge_photo[0]['name'] }}">
                                        @endif
                                    @else
                                        <img src="{{asset('img/default-badge.png')}}" class="w-full" />
                                    @endif
                                </div>
                                <div class="col-span-8">
                                    <h1 class="font-semibold mb-2 text-xl" x-text="badge_name"></h1>
                                    <p x-text="badge_last_name"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="badge_name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="badge_name" name="name" wire:model="badge_name" x-model="badge_name" />
                                @error('badge_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="badge_last_name">Last Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="badge_last_name" name="badge_last_name" wire:model="badge_last_name" x-model="badge_last_name" />
                                @error('badge_last_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <h5 class="font-semibold my-5">Upload identity document</h5>
                        <p>National: DNI<br>Foreigners: Passport<br>Only PDFs are accepted.</p>

                        <h5 class="font-semibold my-5">Upload photo</h5>
                        <livewire:dropzone wire:model="badge_photo" :rules="['image', 'mimes:png,jpeg', 'max:10420']" :key="'dropzone-one'" />

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            <button type="submit" class="btn btn-primary">Finish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
