<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
     style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <x-steps :quantity="2" :current="1" :complete="0" :back_step="true" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Invoices details</h3>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Voucher type</h5>
                    <div class="flex justify-center items-center space-x-5 mb-6">
                        <button type="button" wire:click.prevent="change_voucher_type('{{\App\Concerns\Enums\Types::NATIONAL->value}}')"
                            class="btn {{($data['voucher_type'] === \App\Concerns\Enums\Types::NATIONAL->value ? 'btn-gray' : 'btn-white-outline')}}">National</button>
                        <button type="button" wire:click.prevent="change_voucher_type('{{\App\Concerns\Enums\Types::FOREIGNER->value}}')"
                            class="btn {{($data['voucher_type'] === \App\Concerns\Enums\Types::FOREIGNER->value ? 'btn-gray' : 'btn-white-outline')}}">Foreigner</button>
                    </div>

                    @if($data['voucher_type'] === \App\Concerns\Enums\Types::NATIONAL->value)
                        <div class="form-group">
                            <label for="business">Select Preferred Proof of Payment</label>
                            <div class="form-field">
                                <select id="document_type" name="document_type" wire:model.live="data.document_type">
                                    <option value="">Select...</option>
                                    <option value="{{\App\Concerns\Enums\Types::INVOICE->value}}">{{\App\Concerns\Enums\Types::INVOICE->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Types::TICKET->value}}">{{\App\Concerns\Enums\Types::TICKET->value}}</option>
                                </select>
                                @error('data.document_type') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if($data['document_type'] === \App\Concerns\Enums\Types::INVOICE->value)
                            <div class="form-group">
                                <label for="data.ruc">Taxpayer Identification Number RUC*</label>
                                <div class="form-field">
                                    <input type="text" id="data.ruc" name="data.ruc" wire:model="data.ruc" />
                                    @error('data.ruc') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="data.business_name">Business name*</label>
                                <div class="form-field">
                                    <input type="text" id="data.business_name" name="data.business_name" wire:model="data.business_name" />
                                    @error('data.business_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif

                        @if($this->data['document_type'] === \App\Concerns\Enums\Types::TICKET->value)
                            <div class="form-group">
                                <label for="data.name">Name(s)*</label>
                                <div class="form-field">
                                    <input type="text" id="data.name" name="data.name" wire:model="data.name" />
                                    @error('data.name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="data.last_name">Last Name(s)*</label>
                                <div class="form-field">
                                    <input type="text" id="data.last_name" name="data.last_name" wire:model="data.last_name" />
                                    @error('data.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($data['voucher_type'] === \App\Concerns\Enums\Types::FOREIGNER->value)
                        <div class="form-group">
                            <label for="data.client">Client*</label>
                            <div class="form-field">
                                <input type="text" id="data.client" name="data.client" wire:model="data.client" />
                                @error('data.client') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data.id">ID*</label>
                            <div class="form-field">
                                <input type="text" id="data.id" name="data.id" wire:model="data.id" />
                                @error('data.id') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="data.physical_address">Physical Address*</label>
                        <div class="form-field">
                            <input type="text" id="data.physical_address" name="data.physical_address" wire:model="data.physical_address" />
                            @error('data.physical_address') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="data.email_address">Email Address*</label>
                        <div class="form-field">
                            <input type="text" id="data.email_address" name="data.email_address" wire:model="data.email_address" />
                            @error('data.email_address') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-span-4"></div>
                        <div class="form-field">
                            <div class="form-check">
                                <input type="checkbox" name="data.accept_policy" class="form-check-input" id="data.accept_policy" wire:model="data.accept_policy">
                                <label for="data.accept_policy" class="text-gray">I accept<a href="#" class="text-blue underline ml-1" target="_blank"> the Personal Data Privacy Policy</a></label>
                            </div>
                            @error('data.accept_policy') <span class="validation-error checkbox">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h5 class="font-semibold mt-10 mb-5">Total payment</h5>
                    <div class="form-group">
                        <label>Delegate Registration</label>
                        <div class="form-field">
                            <input type="text" disabled value="${{number_format($amount)}}" />
                        </div>
                    </div>

                    <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                        <a href="{{route('progress')}}" class="btn btn-primary-outline">Return</a>
                        <button type="button" class="btn btn-primary" wire:click.prevent="process">Go to pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
