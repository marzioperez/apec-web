<div x-data="{
        badge_name: '{{$badge_name}}',
        badge_last_name: '{{$badge_last_name}}',
        cover: '{{$cover}}'
    }"
     x-on:set-cover.window="cover = $event.detail.cover"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <div class="relative">

    </div>

    <x-steps :quantity="5" :current="5" :complete="4" />

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
                                    <img :src="cover" class="w-full" />
                                </div>
                                <div class="col-span-8 flex items-center">
                                    <div>
                                        <h1 class="font-semibold mb-2 text-xl" x-text="badge_name"></h1>
                                        <p x-text="badge_last_name"></p>
                                    </div>
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

                        <h5 class="font-semibold my-5">Upload identity document*</h5>
                        @php
                            $doc_content = '<div class="flex justify-center items-center space-x-3 mb-5">';
                            $doc_content .= '<img src="'. asset('img/upload-icon.png') .'" />';
                            if ($user['document_type'] === \App\Concerns\Enums\Types::DNI->value) {
                                $doc_content .= '<img src="'. asset('img/dni-icon.png') .'" />';
                            }
                            if ($user['document_type'] === \App\Concerns\Enums\Types::PASSPORT->value) {
                                $doc_content .= '<img src="'. asset('img/passport-icon.png') .'" />';
                            }
                            $doc_content .= '</div>';
                            $doc_content .= '<p class="text-center">Choose a file or drag & drop it here.<br>';
                            $doc_content .= '<b>National:</b> DNI, <b>Foreigners:</b> Passport<br>';
                            $doc_content .= 'Only PDFs are accepted.</p>';
                        @endphp
                        <livewire:common.file-upload
                            wire:model="identity_document"
                            :rules="['mimes:pdf', 'max:10420']"
                            :key="'identity-document'"
                            :content="$doc_content"
                        />
                        @error('identity_document') <span class="validation-error">{{ $message }}</span> @enderror

                        <h5 class="font-semibold my-5">Upload photo*</h5>
                        @php
                            $photo_content = '<div class="flex justify-center mb-5">';
                            $photo_content .= '<img src="'. asset('img/upload-icon.png') .'" />';
                            $photo_content .= '</div>';
                            $photo_content .= '<p class="text-center">Choose a file or drag & drop it here.<br>';
                            $photo_content .= 'JPEG or PNG formats, 300 x 300 pixels. Background<br>';
                            $photo_content .= 'white. High resolution.</p>';
                        @endphp
                        <livewire:common.file-upload
                            wire:model="badge_photo"
                            :rules="['image', 'mimes:png,jpeg', 'max:10420']"
                            :key="'badge-photo'"
                            :content="$photo_content"
                        />
                        @error('badge_photo') <span class="validation-error">{{ $message }}</span> @enderror

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            <button type="submit" class="btn btn-primary">Finish</button>
                        </div>
                    </form>
                </div>
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
                <h1 class="font-bold text-lg mb-3">Thank you for completing your registration.</h1>
                <div class="mb-5">Please check your inbox, we will contact you soon.</div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Go home</a>
            </div>
        </x-slot:body>
    </x-modal>
</div>
