@props(['data'])
<div class="w-full sm:px-10 px-6 cursor-pointer" x-on:click.prevent="$dispatch('show-speaker', {speaker: {{json_encode($data)}} })">
    <div class="mb-3 flex justify-center">
        <img src="{{url('storage/web/' . $data['photo'])}}" class="sm:w-[200px] w-full rounded-full p-2 border-2 border-orange">
    </div>
    <div class="text-center">
        <h6 class="text-orange font-semibold text-lg mb-2">{{$data['name']}}</h6>
        <div class="text-white line-clamp-2 text-sm mb-4">{!! $data['summary'] !!}</div>
        <div class="text-white font-semibold">{{$data['company']}}</div>
    </div>
</div>
