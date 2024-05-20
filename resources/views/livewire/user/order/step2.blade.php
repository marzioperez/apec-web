<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
     style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <x-steps :quantity="2" :current="2" :complete="1" :back_step="true" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Payment method</h3>
                <div class="my-8 px-5">
                    <div class="flex justify-center items-center space-x-5 mb-6">
                        <button type="button" wire:click.prevent="change_payment_method('{{\App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value}}')"
                                class="btn {{($data['payment_method'] === \App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value ? 'btn-gray' : 'btn-white-outline')}}">Credit card</button>
                        <button type="button" wire:click.prevent="change_payment_method('{{\App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value}}')"
                                class="btn {{($data['payment_method'] === \App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value ? 'btn-gray' : 'btn-white-outline')}}">Bank transfer</button>
                    </div>

                    @if($data['payment_method'] === \App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value)
                        <h5 class="font-semibold mb-5">Payment information</h5>
                        <p class="mb-2">BANCO DE CRÉDITO DEL PERÚ<br>
                        SWIFT code: BCPLPEPL<br>
                        Address: Av. Las Camelias 750 San Isidro L27 Lima Perú<br>
                        Beneficiary name: COMEXPERU - SOCIEDAD DE COMERCIO EXTERIOR DEL PERU<br>
                        Account Nro. 193-2228297-1-59</p>

                        <p class="mb-2">The only commission charged by BCP for receiving transfers from abroad is UDS25.00 of the amount entered into the bank's system.</p>

                        <p>Please verify the commission charge for intermediation service and/or credit from your issuing bank.</p>
                    @endif

                    <h5 class="font-semibold mt-10 mb-5">Total payment</h5>
                    <div class="form-group">
                        <label>Delegate Registration</label>
                        <div class="form-field">
                            <input type="text" disabled value="${{number_format($amount)}}" />
                        </div>
                    </div>

                    @if($data['payment_method'] === \App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value)
                        <livewire:common.culqi-form :amount="$amount" />
                    @endif

                    @if($data['payment_method'] === \App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value)
                        <p><b>Step 1:</b> Initiate a bank transfer to the designated bank account provided in the Payment Information section<br>
                            <b>Step 2:</b> Once the transfer is completed, kindly upload the payment receipt or proof of the bank transaction.</p>

                        <p class="mb-6">Please include your full name, phone number, and email for reference.</p>

                        <div class="form-group">
                            <label for="payment_reference_name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="payment_reference_name" name="payment_reference_name" wire:model="data.payment_reference_name" />
                                @error('data.payment_reference_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_reference_last_name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="payment_reference_last_name" name="payment_reference_last_name" wire:model="data.payment_reference_last_name" />
                                @error('data.payment_reference_last_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_reference_phone">Phone Number*</label>
                            <div class="form-field">
                                <input type="text" id="payment_reference_phone" name="payment_reference_phone" wire:model="data.payment_reference_phone" />
                                @error('data.payment_reference_phone') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_reference_email">Email Address*</label>
                            <div class="form-field">
                                <input type="text" id="payment_reference_email" name="payment_reference_email" wire:model="data.payment_reference_email" />
                                @error('data.payment_reference_email') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <h5 class="font-semibold my-5">Upload voucher*</h5>
                        @php
                            $photo_content = '<div class="flex justify-center mb-5">';
                            $photo_content .= '<img src="'. asset('img/upload-icon.png') .'" />';
                            $photo_content .= '</div>';
                            $photo_content .= '<p class="text-center">Choose a file or drag & drop it here.<br>';
                            $photo_content .= 'JPEG or PNG formats</p>';
                        @endphp
                        <livewire:common.file-upload
                            wire:model="data.payment_voucher"
                            :rules="['image', 'mimes:png,jpeg', 'max:10420']"
                            :key="'payment-voucher'"
                            :content="$photo_content"
                            :emitter="'cover'"
                        />
                        @error('data.payment_voucher') <span class="validation-error">{{ $message }}</span> @enderror

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            <button type="button" class="btn btn-primary" wire:click.prevent="process">Submit</button>
                        </div>
                    @endif
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
                <h1 class="font-bold text-lg mb-3">¡Successfully payment!</h1>
                <div class="mb-5">
                    <p class="mb-2">Your payment has been successfully processed.</p>
                    <p>With the information provided, we will now proceed with the final security validation.</p>
                </div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Go home</a>
            </div>
        </x-slot:body>
    </x-modal>

    <x-modal name="modal-status-error">
        <x-slot:body>
            <div class="flex justify-center mb-3">
                <svg width="62" height="62" viewBox="0 0 82 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="13" y="15" width="46" height="42" fill="white"/>
                    <path d="M41 0C18.3563 0 0 18.3563 0 41C0 63.6437 18.3563 82 41 82C63.6437 82 82 63.6437 82 41C82 18.3563 63.6437 0 41 0ZM58.5921 19.2037L67.1104 27.722L40.5045 54.3331L32.0362 62.7963L23.5179 54.278L14.8895 45.6445L23.3528 37.1812L31.9812 45.8146L58.5921 19.2037Z" fill="#009600"/>
                </svg>
            </div>
            <div class="text-center">
                <h1 class="font-bold text-lg mb-3">Payment error</h1>
                <div class="mb-5">
                    <p class="mb-2">Your payment has not been processed</p>
                    <p>Try using another payment method to finish this process.</p>
                </div>
                <a href="#" x-on:click.prevent="window.location.reload()" class="btn btn-secondary">Try again</a>
            </div>
        </x-slot:body>
    </x-modal>
</div>
