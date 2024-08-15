<div class="grid sm:grid-cols-center-5 grid-cols-center-2 sm:gap-12 gap-6">
    @foreach($sponsors as $item)
        @if($item['logo'])
            <div class="w-full cursor-pointer flex items-center" x-on:click.prevent="$dispatch('show-sponsor', {sponsor: {{json_encode($item)}} })">
                <img src="{{url('storage/web/' . $item['logo'])}}" class="object-center w-full" />
            </div>
        @else
            <div class="w-full"></div>
        @endif
    @endforeach
</div>
