<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px]" x-data="{category: 0}" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-white font-semibold text-5xl uppercase">{{$data['title']}}</h4>
        </div>
        <div class="col-span-full pb-5 flex justify-center space-x-3">
            @foreach($categories as $c => $category)
                <button type="button" class="btn" x-on:click.prevent="category = {{$c}}" :class="category == {{$c}} ? 'btn-orange' : 'btn-orange-outline'">{{$category['name']}}</button>
            @endforeach
        </div>
        <div class="col-span-full py-6">
            @foreach($categories as $c => $category)
                <div x-show="category == {{$c}}">
                    <livewire:common.category-sponsors :sponsors="$category->sponsors->toArray()" :id="$category['id']" wire:key="{{$category['id']}}" />
                </div>
            @endforeach
        </div>
    </div>

    <x-modal name="modal-sponsor" bg="black">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            @if($sponsor)
                <div>
                    <div class="mb-3 sm:grid grid-cols-12 gap-6">
                        <div class="col-span-5 flex justify-center sm:mb-0 mb-3">
                            <div class="w-full bg-white/30 px-6 py-6 rounded-xl cursor-pointer transition-all flex items-center">
                                <img src="{{url('storage/web/' . $sponsor['logo'])}}" class="object-center w-full">
                            </div>
                        </div>
                        <div class="col-span-7 flex items-center">
                            <div>
                                <h6 class="text-white font-semibold text-lg mb-2 sm:text-start text-center">{{$sponsor['name']}}</h6>
                                @if($sponsor['social_networks'])
                                    <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                        @foreach($sponsor['social_networks'] as $item)
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
                        <div class="col-span-full mt-5 text-sm text-white">
                            {!! $sponsor['description'] !!}
                        </div>
                    </div>
                </div>
            @endif
        </x-slot:body>
    </x-modal>
</div>
