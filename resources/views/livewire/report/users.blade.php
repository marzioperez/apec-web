<div class="grid flex-1 auto-cols-fr gap-y-8">

    <div style="--cols-default: repeat(12, minmax(0, 1fr));" class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
        <div style="--col-span-default: span 3 / span 3" class="col-[--col-span-default]">
            <section class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" id="data.datos-de-formulario">
                <header class="fi-section-header flex flex-col gap-3 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="grid flex-1 gap-y-1">
                            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">Campos disponibles</h3>
                        </div>
                    </div>
                </header>

                <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10">
                    <div class="fi-section-content p-6" style="height: 400px; overflow-y: scroll;">
                        <div data-field-wrapper="" class="fi-fo-field-wrp">
                            <div class="grid gap-y-2">
                                <div class="flex gap-x-3 ">
                                    <input type="checkbox" name="filters" id="all" wire:model.live="check_all">
                                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="all">
                                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Seleccionar todo</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        @foreach($fields as $field)
                            <div data-field-wrapper="" class="fi-fo-field-wrp">
                                <div class="grid gap-y-2">
                                    <div class="flex gap-x-3 ">
                                        <input type="checkbox" name="filters" id="{{$field['value']}}" wire:model.live="filters" value="{{$field['value']}}">
                                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="{{$field['value']}}">
                                            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                {{$field['label']}}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <div class="fi-form-actions mt-6">
                <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
                    <button style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" type="button" wire:loading.attr="disabled" wire:click="process">
                        Generar reporte
                    </button>
                    @if(count($users) > 0)
                        <button wire:click.prevent="export" style="--c-400:var(--success-400);--c-500:var(--success-500);--c-600:var(--success-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" type="button" wire:loading.attr="disabled" wire:click="export">
                            Exportar en Excel
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div style="--col-span-default: span 9 / span 9;" class="col-[--col-span-default]">
            @if(empty($columns))
                <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10 !border-t-0">
                    <div class="fi-ta-empty-state px-6 py-12">
                        <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                            <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                                <svg class="fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h4 class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                                No se encontraron registros
                            </h4>
                        </div>
                    </div>
                </div>
            @else
                <div class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
                    <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10 !border-t-0">
                        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                            <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                <tr class="bg-gray-50 dark:bg-white/5">
                                    @foreach($columns as $column)
                                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                                    {{$column['label']}}
                                                </span>
                                            </span>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                @foreach($users as $user)
                                    <tr class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                                        @foreach ($filters as $filter)
                                            <td class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                                                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                                    <span class="fi-ta-header-cell-label text-sm text-gray-950 dark:text-white">
                                                        @if($filter === 'vaccines')
                                                            @if(!is_null($user[$filter]))
                                                                {{implode(', ', $user[$filter])}}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            {{$user[$filter]}}
                                                        @endif
                                                    </span>
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($users) > 0)
                    <div class="mt-6">{{$users->links()}}</div>
                @endif
            @endif
        </div>
    </div>
</div>
