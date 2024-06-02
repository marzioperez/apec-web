<div class="relative">
    <img src="{{asset('img/trama-2-1.png')}}" class="absolute top-1/4 sm:w-[580px] w-[500px] z-[5] opacity-40 right-0">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px] relative z-10" x-data="{category: 0}" id="{{$data['id']}}">
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
    </div>
</div>
