@php
    $size = 5;
    if (count($sponsors) === 1) {
        $size = 4;
    }
@endphp
<div class="grid sm:grid-cols-center-{{$size}} grid-cols-center-2 sm:gap-12 gap-6">
    @foreach($sponsors as $item)
        <div class="w-full cursor-pointer flex items-center" x-on:click.prevent="$dispatch('show-sponsor', {sponsor: {{json_encode($item)}} })">
            <img src="{{url('storage/web/' . $item['logo'])}}" class="object-center w-full" />
        </div>
    @endforeach
</div>
