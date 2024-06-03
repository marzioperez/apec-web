<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
     style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')"
    x-data="{
        payment_method: '{{$data['payment_method']}}'
    }"
    x-on:toggle-payment-method.window="payment_method = $event.detail.method">

    <x-steps :quantity="2" :current="2" :complete="1" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Payment method</h3>
                <div class="my-8 px-5">
                    <div x-show="payment_method === '{{\App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value}}'">
                        <div class="flex justify-center items-center space-x-5 mb-6">
                            <button type="button" class="btn btn-white-outline" x-on:click="$dispatch('update-payment-method', {method: '{{\App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value}}'})">Credit card</button>
                            <button type="button" class="btn btn-gray" x-on:click="$dispatch('update-payment-method', {method: '{{\App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value}}'})">Bank transfer</button>
                        </div>

                        <h5 class="font-semibold mb-5">Payment information</h5>
                        <p class="mb-2"><b>Bank name:</b> BANCO DE CRÉDITO DEL PERÚ<br>
                            <b>SWIFT code:</b> BCPLPEPL<br>
                            <b>Address:</b> Av. Las Camelias 750 San Isidro L27 Lima Perú<br>
                            <b>Beneficiary name:</b> COMEXPERU - SOCIEDAD DE COMERCIO EXTERIOR DEL PERU<br>
                        <b>Account number:</b> 193-2228297-1-59</p>

                        <p class="mb-2">Please make sure the SWIFT transfer is processed in OUR.</p>

                        <h5 class="font-semibold mt-10 mb-5">Total payment</h5>
                        <div class="form-group">
                            <label>Delegate Registration</label>
                            <div class="form-field">
                                <input type="text" disabled value="${{number_format($amount)}}" />
                            </div>
                        </div>
                    </div>

                    <div x-show="payment_method === '{{\App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value}}'">
                        <div class="flex justify-center items-center space-x-5 mb-6">
                            <button type="button" class="btn btn-gray" x-on:click="$dispatch('update-payment-method', {method: '{{\App\Concerns\Enums\PaymentMethods::CREDIT_CARD->value}}'})">Credit card</button>
                            <button type="button" class="btn btn-white-outline" x-on:click="$dispatch('update-payment-method', {method: '{{\App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value}}'})">Bank transfer</button>
                        </div>

                        <livewire:common.culqi-form :amount="$amount" />
                    </div>

                    <div x-show="payment_method === '{{\App\Concerns\Enums\PaymentMethods::BANK_TRANSFER->value}}'">
                        <p><b>Step 1:</b> Instruct your bank an international wire transfer to the designated bank account provided above.<br>
                            <b>Step 2:</b> Once the transfer is processed, kindly upload the bank transaction slip.</p>

                        <p class="mb-6">Please include your full name, phone number, and email for reference.</p>

                        <div class="form-group">
                            <label for="payment_reference_name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="payment_reference_name" name="payment_reference_name" wire:model="data.payment_reference_name" />
                                @error('data.payment_reference_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_reference_last_name">Last Name(s)*</label>
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
                            <button type="button" class="btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: 1 })">Back</button>
                            <button type="button" class="btn btn-primary" wire:click.prevent="process">Submit</button>
                        </div>
                    </div>
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
                <h1 class="font-bold text-lg mb-3">Payment Successful!</h1>
                <div class="mb-5">
                    <p class="mb-2">Your payment has been processed successfully. You will receive a confirmation email within the next few minutes. Your information will now go through a final review.</p>
                </div>
                <a href="{{config('app.url')}}" class="btn btn-primary">Back home</a>
            </div>
        </x-slot:body>
    </x-modal>

    <x-modal name="modal-status-error">
        <x-slot:body>
            <div class="flex justify-center mb-3">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25 0C20.0555 0 15.222 1.46622 11.1108 4.21326C6.99952 6.96029 3.79521 10.8648 1.90302 15.4329C0.0108321 20.0011 -0.484251 25.0277 0.480379 29.8772C1.44501 34.7268 3.82603 39.1813 7.32234 42.6777C10.8186 46.174 15.2732 48.555 20.1227 49.5196C24.9723 50.4842 29.9989 49.9892 34.5671 48.097C39.1352 46.2048 43.0397 43.0005 45.7867 38.8892C48.5338 34.778 50 29.9445 50 25C50 21.7169 49.3533 18.466 48.097 15.4329C46.8406 12.3998 44.9991 9.64379 42.6777 7.32233C40.3562 5.00086 37.6002 3.15938 34.5671 1.90301C31.5339 0.646644 28.283 0 25 0ZM31.775 28.225C32.0093 28.4574 32.1953 28.7339 32.3222 29.0385C32.4491 29.3432 32.5145 29.67 32.5145 30C32.5145 30.33 32.4491 30.6568 32.3222 30.9614C32.1953 31.2661 32.0093 31.5426 31.775 31.775C31.5426 32.0093 31.2661 32.1953 30.9614 32.3222C30.6568 32.4491 30.33 32.5145 30 32.5145C29.67 32.5145 29.3432 32.4491 29.0386 32.3222C28.7339 32.1953 28.4574 32.0093 28.225 31.775L25 28.525L21.775 31.775C21.5426 32.0093 21.2661 32.1953 20.9614 32.3222C20.6568 32.4491 20.33 32.5145 20 32.5145C19.67 32.5145 19.3432 32.4491 19.0386 32.3222C18.7339 32.1953 18.4574 32.0093 18.225 31.775C17.9907 31.5426 17.8047 31.2661 17.6778 30.9614C17.5509 30.6568 17.4855 30.33 17.4855 30C17.4855 29.67 17.5509 29.3432 17.6778 29.0385C17.8047 28.7339 17.9907 28.4574 18.225 28.225L21.475 25L18.225 21.775C17.7542 21.3042 17.4898 20.6657 17.4898 20C17.4898 19.3342 17.7542 18.6958 18.225 18.225C18.6958 17.7542 19.3342 17.4898 20 17.4898C20.6658 17.4898 21.3042 17.7542 21.775 18.225L25 21.475L28.225 18.225C28.6958 17.7542 29.3342 17.4898 30 17.4898C30.6658 17.4898 31.3042 17.7542 31.775 18.225C32.2458 18.6958 32.5102 19.3342 32.5102 20C32.5102 20.6657 32.2458 21.3042 31.775 21.775L28.525 25L31.775 28.225Z" fill="#DB2828"/>
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
