@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
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
</div>
