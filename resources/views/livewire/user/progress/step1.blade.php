<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">

    <x-steps :quantity="$quantity" :current="$current" :complete="0" :back_step="true" />

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
                                <select id="title" name="title" wire:model="title">
                                    <option value="">Select...</option>
                                    <option value="{{\App\Concerns\Enums\Titles::MR->value}}">{{\App\Concerns\Enums\Titles::MR->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Titles::MRS->value}}">{{\App\Concerns\Enums\Titles::MRS->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Titles::MS->value}}">{{\App\Concerns\Enums\Titles::MS->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Titles::DR->value}}">{{\App\Concerns\Enums\Titles::DR->value}}</option>
                                </select>
                                @error('title') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="name" name="name" wire:model="name" />
                                @error('name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name(s)*</label>
                            <div class="form-field">
                                <input type="text" id="last_name" name="last_name" wire:model="last_name" />
                                @error('last_name') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender*</label>
                            <div class="form-field">
                                <select id="gender" name="gender" wire:model="gender">
                                    <option value="">Select...</option>
                                    <option value="{{\App\Concerns\Enums\Genders::MALE->value}}">{{\App\Concerns\Enums\Genders::MALE->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Genders::FEMALE->value}}">{{\App\Concerns\Enums\Genders::FEMALE->value}}</option>
                                </select>
                                @error('gender') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document_type">Type of Document*</label>
                            <div class="form-field">
                                <select id="document_type" name="document_type" wire:model="document_type">
                                    <option value="">Select...</option>
                                    <option value="{{\App\Concerns\Enums\Types::DNI->value}}">{{\App\Concerns\Enums\Types::DNI->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Types::PASSPORT->value}}">{{\App\Concerns\Enums\Types::PASSPORT->value}}</option>
                                    <option value="{{\App\Concerns\Enums\Types::CE->value}}">{{\App\Concerns\Enums\Types::CE->value}}</option>
                                </select>
                                @error('document_type') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="document_number">Document Number*</label>
                            <div class="form-field">
                                <input type="text" id="document_number" name="document_number" wire:model="document_number" />
                                @error('document_number') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email*</label>
                            <div class="form-field">
                                <input type="email" id="email" name="email" wire:model="email" />
                                @error('email') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_issue">Date of Issue*</label>
                            <div class="form-field">
                                <input type="date" id="date_of_issue" name="date_of_issue" wire:model="date_of_issue" />
                                @error('date_of_issue') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="place_of_issue">Place of Issue*</label>
                            <div class="form-field">
                                <input type="text" id="place_of_issue" name="place_of_issue" wire:model="place_of_issue" />
                                @error('place_of_issue') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth*</label>
                            <div class="form-field">
                                <input type="date" id="date_of_birth" name="date_of_birth" wire:model="date_of_birth" />
                                @error('date_of_birth') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality*</label>
                            <div class="form-field">
                                <input type="text" id="nationality" name="nationality" wire:model="nationality" />
                                @error('nationality') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city_of_permanent_residency">City of Permanent Residency*</label>
                            <div class="form-field">
                                <input type="text" id="city_of_permanent_residency" name="city_of_permanent_residency" wire:model="city_of_permanent_residency" />
                                @error('city_of_permanent_residency') <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="sm:my-8 my-6 flex justify-center space-x-6 items-center">
                            <button type="button" class="btn btn-gray" wire:click.prevent="save">Save</button>
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
