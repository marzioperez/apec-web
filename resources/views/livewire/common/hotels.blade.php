<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-primary-dark font-semibold text-5xl uppercase">{{$data['title']}}</h4>
        </div>
        <div class="col-span-full py-6">
            <div class="grid sm:grid-cols-center-5 grid-cols-center-2 gap-6">
                @foreach($hotels as $hot)
                    <img src="{{url('storage/web/' . $hot['photo'])}}" class="sm:w-[200px] w-full sm:mb-0 mb-5 cursor-pointer" x-on:click.prevent="$dispatch('show-hotel', {hotel: {{json_encode($hot)}} })">
                @endforeach
            </div>
        </div>
    </div>
</div>
