<div class="relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px] relative z-10" x-data="{category: 0}" id="{{$data['id']}}">
        <div class="sm:grid grid-cols-12 gap-x-12">
            <div class="col-span-full pb-5">
                <h4 class="text-white font-semibold text-5xl uppercase">{{$data['title']}}</h4>
            </div>
            <div class="col-span-full pb-5">
                <div wire:ignore x-data="{
                    init() {
                        new Splide(this.$refs.category_sponsors, {
                            perPage: 5,
                            gap: 10,
                            arrows: false,
                            drag: false,
                            pagination: false,
                            destroy: true,
                            breakpoints: {
                                1024: {
                                    perPage: 3,
                                    drag: true,
                                    pagination: true,
                                    destroy: false
                                },
                                640: {
                                    perPage: 2,
                                    drag: true,
                                    pagination: true,
                                    destroy: false
                                }

                            }
                        }).mount()
                    }
                }">
                    <div x-ref="category_sponsors" class="splide sponsors-carousel">
                        <div class="splide__track">
                            <ul class="splide__list sm:!flex sm:justify-center sm:space-x-3">
                                @foreach($categories as $c => $category)
                                    <li class="splide__slide flex items-center justify-center">
                                        <button type="button" class="btn" x-on:click.prevent="category = {{$c}}" :class="category == {{$c}} ? 'btn-orange' : 'btn-orange-outline'">{{$category['name']}}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
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
