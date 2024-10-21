<div x-data="{
        medical_treatment: '{{$data['medical_treatment']}}'
    }"
    class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom"
    style="background-image: url('{{asset("img/bg-sign-up-step-1.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="$complete" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <p>Safety is our top priority. Please provide us with your medical information for our records.</p>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">Medical information</h5>
                    <form wire:submit.prevent="process">
                        <div class="form-group">
                            <label for="blood_type">Blood type*</label>
                            <div class="form-field">
                                <select id="blood_type" name="blood_type" wire:model="data.blood_type" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    <option value="A+">A+</option>
                                    <option value="O+">O+</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A-">A-</option>
                                    <option value="O-">O-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="AB-">N/A</option>
                                </select>
                                @error('data.blood_type') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Allergies*</label>
                            <div class="form-field flex space-x-6">
                                <div class="flex items-center gap-x-3">
                                    <input id="allergies_yes" name="allergies" type="radio" wire:model.live="data.allergies" value="yes" @change="allergies = 'yes'" :disabled="{{$lock_fields}}" />
                                    <label for="allergies_yes">Yes</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input id="allergies_no" name="allergies" type="radio" wire:model.live="data.allergies" value="no" @change="allergies = 'no'" :disabled="{{$lock_fields}}" />
                                    <label for="allergies_no">No</label>
                                </div>
                            </div>
                        </div>
                        @if($data['allergies'] === 'yes')
                            <div class="form-group">
                                <label for="allergy_details">Details</label>
                                <div class="form-field">
                                    <textarea id="allergy_details" name="allergy_details" wire:model="data.allergy_details" :disabled="{{$lock_fields}}"></textarea>
                                    @error('data.allergy_details') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="vaccines">Vaccines</label>
                            <div class="form-field">
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="vaccines_covid" type="checkbox" value="COVID-19" wire:model="data.vaccines" :disabled="{{$lock_fields}}">
                                    </div>
                                    <label for="vaccines_covid">COVID-19</label>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="vaccines_hep_a" type="checkbox" value="Hepatitis A" wire:model="data.vaccines" :disabled="{{$lock_fields}}">
                                    </div>
                                    <label for="vaccines_hep_a">Hepatitis A</label>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="vaccines_hep_b" type="checkbox" value="Hepatitis B" wire:model="data.vaccines" :disabled="{{$lock_fields}}">
                                    </div>
                                    <label for="vaccines_hep_b">Hepatitis B</label>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="vaccines_yellow_fever" type="checkbox" value="Yellow fever" wire:model="data.vaccines" :disabled="{{$lock_fields}}">
                                    </div>
                                    <label for="vaccines_yellow_fever">Yellow fever</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="medical_others">Others</label>
                            <div class="form-field">
                                <textarea id="medical_others" name="medical_others" wire:model="medical_others" :disabled="{{$lock_fields}}"></textarea>
                                @error('medical_others') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="medical_treatment">Medical Treatment*</label>
                            <div class="form-field flex space-x-6">
                                <div class="flex items-center gap-x-3">
                                    <input id="medical_treatment_yes" name="medical_treatment" type="radio" wire:model="data.medical_treatment" value="yes" @change="medical_treatment = 'yes'" :disabled="{{$lock_fields}}" />
                                    <label for="medical_treatment_yes">Yes</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input id="medical_treatment_no" name="medical_treatment" type="radio" wire:model="data.medical_treatment" value="no" @change="medical_treatment = 'no'" :disabled="{{$lock_fields}}" />
                                    <label for="medical_treatment_no">No</label>
                                </div>
                            </div>
                        </div>

                        <div x-show="medical_treatment === 'yes'">
                            <div class="form-group">
                                <label for="medical_treatment_details">Details*</label>
                                <div class="form-field">
                                    <textarea id="medical_treatment_details" name="medical_treatment_details" wire:model="data.medical_treatment_details" :disabled="{{$lock_fields}}"></textarea>
                                    @error('data.medical_treatment_details') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="taking_any_medication">Under permanent medication?</label>
                                <div class="form-field">
                                    <input type="text" id="taking_any_medication" name="taking_any_medication" wire:model="data.taking_any_medication" :disabled="{{$lock_fields}}" />
                                    @error('data.taking_any_medication') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="chemical_name">Active ingredient</label>
                                <div class="form-field">
                                    <input type="text" id="chemical_name" name="chemical_name" wire:model="data.chemical_name" :disabled="{{$lock_fields}}" />
                                    @error('data.chemical_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="brand_trade_name">Commercial name</label>
                                <div class="form-field">
                                    <input type="text" id="city" name="brand_trade_name" wire:model="data.brand_trade_name" :disabled="{{$lock_fields}}" />
                                    @error('data.brand_trade_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dosis">Dosis</label>
                                <div class="form-field">
                                    <input type="text" id="dosis" name="dosis" wire:model="data.dosis" :disabled="{{$lock_fields}}" />
                                    @error('data.dosis') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="frequency">Frequency</label>
                                <div class="form-field">
                                    <input type="text" id="frequency" name="frequency" wire:model="data.frequency" :disabled="{{$lock_fields}}" />
                                    @error('data.frequency') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <h5 class="font-semibold my-3">Doctor’s information</h5>
                            <div class="form-group">
                                <label for="dr_name">Name</label>
                                <div class="form-field">
                                    <input type="text" id="dr_name" name="dr_name" wire:model="data.dr_name" :disabled="{{$lock_fields}}" />
                                    @error('data.dr_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dr_last_name">Last Name(s)</label>
                                <div class="form-field">
                                    <input type="text" id="dr_last_name" name="dr_last_name" wire:model="data.dr_last_name" :disabled="{{$lock_fields}}" />
                                    @error('data.dr_last_name') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dr_number">Phone Number</label>
                                <div class="form-field">
                                    <input type="text" id="dr_number" name="dr_number" wire:model="data.dr_number" :disabled="{{$lock_fields}}" />
                                    @error('data.dr_number') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dr_email">Email Address</label>
                                <div class="form-field">
                                    <input type="email" id="dr_email" name="dr_email" wire:model="data.dr_email" :disabled="{{$lock_fields}}" />
                                    @error('data.dr_email') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <h5 class="font-semibold my-3">International insurance information</h5>
                            <div class="form-group">
                                <label for="insurance_company">Company</label>
                                <div class="form-field">
                                    <input type="text" id="insurance_company" name="insurance_company" wire:model="data.insurance_company" :disabled="{{$lock_fields}}" />
                                    @error('data.insurance_company') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insurance_id_number">Policy number</label>
                                <div class="form-field">
                                    <input type="text" id="insurance_id_number" name="insurance_id_number" wire:model="data.insurance_id_number" :disabled="{{$lock_fields}}" />
                                    @error('data.insurance_id_number') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insurance_phone">Phone Number</label>
                                <div class="form-field">
                                    <input type="text" id="insurance_phone" x-mask="+999999999999999" name="insurance_phone" wire:model="data.insurance_phone" :disabled="{{$lock_fields}}" />
                                    @error('data.insurance_phone') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insurance_other_specifications">Other specifications</label>
                                <div class="form-field">
                                    <input type="text" id="insurance_other_specifications" name="insurance_other_specifications" wire:model="data.insurance_other_specifications" :disabled="{{$lock_fields}}" />
                                    @error('data.insurance_other_specifications') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            @if($lock_fields)
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('update-step', {step: {{$current + 1}} })">Continue</button>
                            @else
                                <button type="button" class="flex items-center btn btn-secondary" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">Back</button>
                                <button type="button" class="btn btn-gray" wire:click.prevent="save(false)">Save</button>
                                <button type="submit" class="btn btn-primary" wire:click.prevent="save(true)">Continue</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
