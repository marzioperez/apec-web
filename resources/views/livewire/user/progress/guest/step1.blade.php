<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="0" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">Register</h3>
                <p>Welcome to the registration platform for the <b>APEC CEO Summit 2024</b>. Please provide us with more information about yourself by completing the fields below.</p>
                <div class="my-8 px-5">
                    <h5 class="font-semibold mb-5">General information</h5>
                    <form wire:submit.prevent="process">
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <div class="form-field">
                                <select id="title" name="title" wire:model="data.title" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    @foreach($titles as $title)
                                        <option value="{{$title['id']}}">{{$title['name']}}</option>
                                    @endforeach
                                </select>
                                @error('data.title') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="name" name="name" value="{{$user['name']}}" disabled />
                                @error('data.name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="last_name" name="last_name" value="{{$user['last_name']}}" disabled />
                                @error('data.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender*</label>
                            <div class="form-field">
                                <select id="gender" name="gender" wire:model="data.gender" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender['id']}}">{{$gender['name']}}</option>
                                    @endforeach
                                </select>
                                @error('data.gender') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <div class="form-field">
                                <input type="email" id="email" name="email" value="{{$user['email']}}" disabled />
                                @error('data.email') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Mobile*</label>
                            <div class="form-field">
                                <input type="text" id="phone" name="phone" placeholder="Ex.: +51 999 999 999" x-mask="+999999999999999" wire:model="data.phone" :disabled="{{$lock_fields}}" />
                                @error('data.phone') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document_type">Type of Document*</label>
                            <div class="form-field">
                                <select id="document_type" name="document_type" wire:model="data.document_type" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    @foreach($document_types as $document_type)
                                        <option value="{{$document_type['id']}}">{{$document_type['name']}}</option>
                                    @endforeach
                                </select>
                                @error('data.document_type') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document_number">Document Number*</label>
                            <div class="form-field">
                                <input type="text" id="document_number" name="document_number" wire:model="data.document_number" :disabled="{{$lock_fields}}" />
                                @error('data.document_number') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_issue">Date of Issue (dd/mm/yyyy)*</label>
                            <div class="form-field">
                                <x-input.date wire:model.live="data.date_of_issue" id="date_of_issue" placeholder="dd/mm/yyyy" :disabled="$lock_fields" :options="['defaultDate' => $data['date_of_issue']]"/>
                                @error('data.date_of_issue') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place_of_issue">Place of Issue*</label>
                            <div class="form-field">
                                <input type="text" id="place_of_issue" name="place_of_issue" wire:model="data.place_of_issue" :disabled="{{$lock_fields}}" />
                                @error('data.place_of_issue') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth (dd/mm/yyyy)*</label>
                            <div class="form-field">
                                <x-input.date wire:model.live="data.date_of_birth" id="date_of_birth" placeholder="dd/mm/yyyy" :disabled="$lock_fields" :options="['defaultDate' => $data['date_of_birth']]"/>
                                @error('data.date_of_birth') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality*</label>
                            <div class="form-field">
                                <input type="text" id="nationality" name="nationality" wire:model="data.nationality" :disabled="{{$lock_fields}}" />
                                @error('data.nationality') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city_of_permanent_residency">City of Residency*</label>
                            <div class="form-field">
                                <input type="text" id="city_of_permanent_residency" name="city_of_permanent_residency" wire:model="data.city_of_permanent_residency" :disabled="{{$lock_fields}}" />
                                @error('data.city_of_permanent_residency') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="business">Company/Organization*</label>
                            <div class="form-field">
                                <input type="text" id="business" name="business" wire:model="data.business" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Position*</label>
                            <div class="form-field">
                                <input type="text" id="role" name="role" wire:model="data.role" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="economy">Economy*</label>
                            <div class="form-field">
                                <select id="economy" name="economy" wire:model.live="data.economy" :disabled="{{$lock_fields}}">
                                    <option value="">Select...</option>
                                    @foreach($economies as $economy)
                                        <option value="{{$economy['id']}}">{{$economy['name']}}</option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                                @error('data.economy') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        @if($data['economy'] === 'other')
                            <div class="form-group">
                                <label for="other_economy">Other economy*</label>
                                <div class="form-field">
                                    <input type="text" id="other_economy" name="other_economy" wire:model="data.other_economy" :disabled="{{$lock_fields}}" />
                                    @error('data.other_economy') <span class="validation-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif

                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            @if($lock_fields)
                                <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('update-step', {step: 2})">Continue</button>
                            @else
                                <button type="button" class="btn btn-gray" wire:click.prevent="save">Save</button>
                                <button type="submit" class="btn btn-primary">Continue</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
