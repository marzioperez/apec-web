<div class="p-6 border-2 border-gray-200 rounded-xl flex items-center relative">
    <div wire:loading>
        <div class="loader rounded-xl z-10">
            <div class="typewriter">
                <div class="slide"><i></i></div>
                <div class="paper"></div>
                <div class="keyboard"></div>
                <div class="loader-text">Cargando...</div>
            </div>
        </div>
    </div>
    <form class="w-full py-6 px-10 block" wire:submit.prevent="process_document_number">
        <div class="grid gap-y-2 pb-4">
            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                <span class="text-sm text-center w-full font-medium leading-6 text-gray-950 dark:text-white">Buscar por número de documento</span>
            </label>
            <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
                <input type="text" class="fi-input block w-full text-center border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3 mb-3" wire:model="document_number" />
            </div>
        </div>
        <button type="submit"
                style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
                class="fi-btn mx-auto relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm block shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action">Consultar</button>
    </form>
</div>
