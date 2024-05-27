<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6">
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

    <x-modal name="modal-hotel" bg="black">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            @if($hotel)
                <div>
                    <div class="mb-3 sm:grid grid-cols-12">
                        <div class="col-span-full px-6 py-3">
                            <img src="{{url('storage/web/' . $hotel['photo'])}}" class="w-full">
                        </div>
                        <div class="col-span-full">
                            <h6 class="text-white font-semibold text-lg sm:text-start text-center">{{$hotel['name']}}</h6>
                        </div>
                        <div class="col-span-full">
                            @foreach(range(1, $hotel['stars'])  as $star)
                                <i class="fa-sharp fa-solid fa-star text-white text-sm"></i>
                            @endforeach
                        </div>
                        <div class="col-span-full mt-5 text-sm text-white">
                            {!! $hotel['description'] !!}
                        </div>
                        @if($hotel['social_networks'])
                            <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                @foreach($hotel['social_networks'] as $item)
                                    <a href="{{$item['data']['url']}}" target="_blank" class="btn-speaker-social">
                                        @if($item['type'] === 'linkedin')
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        @endif
                                        @if($item['type'] === 'facebook')
                                            <i class="fa-brands fa-facebook-f"></i>
                                        @endif
                                        @if($item['type'] === 'web')
                                            <i class="fa-light fa-globe"></i>
                                        @endif
                                        @if($item['type'] === 'instagram')
                                            <i class="fa-brands fa-instagram"></i>
                                        @endif
                                        @if($item['type'] === 'x')
                                            <i class="fa-brands fa-x-twitter"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </x-slot:body>
    </x-modal>
</div>
