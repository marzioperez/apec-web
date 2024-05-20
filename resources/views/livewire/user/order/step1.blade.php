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
                            class="btn {{($data['voucher_type'] === \App\Concerns\Enums\Types::NATIONAL->value ? 'btn-white-outline' : 'btn-gray')}}">National</button>
                        <button type="button" wire:click.prevent="change_voucher_type('{{\App\Concerns\Enums\Types::FOREIGNER->value}}')"
                            class="btn {{($data['voucher_type'] === \App\Concerns\Enums\Types::FOREIGNER->value ? 'btn-white-outline' : 'btn-gray')}}">Foreigner</button>
                    </div>

                    <div class="form-group">
                        <label for="business">Select Preferred Proof of Payment</label>
                        <div class="form-field">
                            <select id="document_type" name="document_type" wire:model="data.document_type">
                                <option value="">Select...</option>
                                <option value="{{\App\Concerns\Enums\Types::INVOICE->value}}">{{\App\Concerns\Enums\Types::INVOICE->value}}</option>
                                <option value="{{\App\Concerns\Enums\Types::TICKET->value}}">{{\App\Concerns\Enums\Types::TICKET->value}}</option>
                            </select>
                            @error('data.document_type') <span class="validation-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if($data['document_type'] === \App\Concerns\Enums\Types::INVOICE->value)

                    @endif

                    @if($data['document_type'] === \App\Concerns\Enums\Types::TICKET->value)

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
