@if($getRecord()->guests)
    @foreach($getRecord()->guests as $guest)
        <div style="--cols-default: repeat(4, minmax(0, 1fr));" class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3 ">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Nombre</span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="fi-fo-placeholder text-sm leading-6">
                                {{$getRecord()->parent->name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3 ">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Apellidos</span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="fi-fo-placeholder text-sm leading-6">
                                {{$getRecord()->parent->last_name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3 ">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Email</span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="fi-fo-placeholder text-sm leading-6">
                                {{$getRecord()->parent->email}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                <div class="fi-fo-field-wrp">
                    <div class="grid gap-y-2">
                        <div class="flex items-center justify-between gap-x-3 ">
                            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Celular</span>
                            </label>
                        </div>
                        <div class="grid gap-y-2">
                            <div class="fi-fo-placeholder text-sm leading-6">{{$guest->phone}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @dump($guest)
    @endforeach
@else
    <p>No se ha encontrado información.</p>
@endif
