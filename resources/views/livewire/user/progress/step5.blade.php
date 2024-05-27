<div x-data="{
        badge_name: '{{$badge_name}}',
        badge_last_name: '{{$badge_last_name}}',
        cover: '{{$cover}}'
    }"
     x-on:set-cover.window="cover = $event.detail.cover"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="$complete" :back_step="true" />

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
                                <input type="text" id="badge_name" name="name" wire:model="badge_name" x-model="badge_name" :disabled="{{$lock_fields}}" />
                                @error('badge_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="badge_last_name">Last Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="badge_last_name" name="badge_last_name" wire:model="badge_last_name" x-model="badge_last_name" :disabled="{{$lock_fields}}" />
                                @error('badge_last_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(in_array($user['status'], [
                            \App\Concerns\Enums\Status::PENDING_APPROVAL_DATA->value,
                            \App\Concerns\Enums\Status::UNPAID->value,
                            \App\Concerns\Enums\Status::PAYMENT_REVIEW->value
                        ]))
                            <h5 class="font-semibold my-5">Identity Document</h5>
                            <div class="mt-3 flex items-center bg-white px-2 py-1 shadow justify-between gap-2 border rounded border-gray-200 w-full h-auto overflow-hidden">
                                <div class="flex items-center gap-3">
                                    <div class="flex justify-center items-center w-14 h-14 bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-start gap-1">
                                        <a class="text-center text-blue-500 underline text-sm font-medium" target="_blank" href="{{$identity_document_file}}">Open</a>
                                    </div>
                                </div>
                            </div>
                        @else
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
                                :emitter="'cover'"
                            />
                            @error('badge_photo') <span class="validation-error">{{ $message }}</span> @enderror
                        @endif

                        @if(in_array($user['status'], [
                            \App\Concerns\Enums\Status::CONFIRMED->value,
                            \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value,
                            \App\Concerns\Enums\Status::UNPAID->value,
                            \App\Concerns\Enums\Status::PAYMENT_REVIEW->value
                        ]))
                            <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                                @if(in_array($user['type'], [
                                    \App\Concerns\Enums\Types::FREE_PASS_STAFF->value,
                                    \App\Concerns\Enums\Types::FREE_PASS_COMPANION->value,
                                    \App\Concerns\Enums\Types::FREE_PASS_STAFF->value,
                                ]))
                                    <button type="submit" class="btn btn-primary">Finish!</button>
                                @else
                                    @if(in_array($user['status'], [
                                        \App\Concerns\Enums\Status::CONFIRMED->value,
                                        \App\Concerns\Enums\Status::UNPAID->value,
                                        \App\Concerns\Enums\Status::PAYMENT_REVIEW->value
                                    ]))
                                        <button type="submit" class="btn btn-primary">Pay now!</button>
                                    @endif
                                    @if($user['status'] === \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value)
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    @endif
                                @endif
                            </div>
                        @endif
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
                <div class="mb-5">Our team will review your information.</div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Go home</a>
            </div>
        </x-slot:body>
    </x-modal>
</div>
