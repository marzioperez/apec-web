@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px]" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5 relative">
            <h4 class="text-secondary font-semibold sm:text-5xl text-4xl uppercase">{{$data['title']}}</h4>
            <h2 class="text-secondary font-bold sm:text-2xl text-xl uppercase">{{$data['sub_title']}}</h2>
        </div>

        <div class="col-span-8">
            <div>
                <div class="text-white mb-5">{!! $data['content'] !!}</div>
                <div class="sm:block hidden">
                    <button type="button" class="btn btn-secondary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-organization'})">{{$data['text_button']}}</button>
                </div>
            </div>
        </div>
        <div class="col-span-4 flex items-center relative">
            <img src="{{url('storage/web/' . $data['image'])}}" class="w-full" />
        </div>
        <div class="sm:hidden flex justify-center sm:pt-0 pt-5">
            <button type="button" class="btn btn-secondary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-organization'})">{{$data['text_button']}}</button>
        </div>
    </div>

    <x-modal name="modal-organization" bg="black !p-0" classes="modal-book">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            <div class="w-full sm:grid grid-cols-12">
                <div class="col-span-7 flex items-center justify-center sm:px-10 px-5">
                    <div>
                        <h3 class="text-secondary text-3xl mb-3 font-bold">{{$data['pop_up_title']}}</h3>
                        <div class="text-white text-sm">{!! $data['pop_up_content'] !!}</div>
                    </div>
                </div>
                <div class="col-span-5">
                    <img src="{{url('storage/web/' . $data['pop_up_image'])}}" class="w-full">
                </div>
            </div>
        </x-slot:body>
    </x-modal>
</div>
