<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6" x-data="{category: 0}">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-blue font-semibold text-5xl uppercase sm:text-end text-left">{{$data['title']}}</h4>
        </div>
        <div class="col-span-full pb-5 flex justify-end space-x-3">
            @foreach($categories as $c => $category)
                <button type="button" class="btn" x-on:click.prevent="category = {{$c}}" :class="category == {{$c}} ? 'btn-blue' : 'btn-blue-outline'">{{$category['name']}}</button>
            @endforeach
        </div>
        @foreach($categories as $c => $category)
            <div class="col-span-full text-white" x-show="category == {{$c}}">
                @foreach($category['days'] as $day)
                    <div class="pt-5">
                        <p class="font-semibold">{{$day['title']}}</p>
                    </div>
                    <div x-data="{ current_activity: null }">
                        @foreach($day['activities'] as $activity)
                            <div class="w-full grid grid-cols-12 gap-5 py-5 border-white/60 border-b" x-data="{
                                activity: {{$activity['id']}},
                                get expanded() {
                                    return this.current_activity === this.activity
                                },
                                set expanded(value) {
                                    this.current_activity = value ? this.activity : null
                                }
                            }">
                                <div class="col-span-3 flex justify-between">
                                    <div>{{ date('H:i', strtotime($activity['start'])) }} - {{ date('H:i', strtotime($activity['end'])) }} Hrs</div>
                                    <div class="cursor-pointer pt-1" x-on:click="expanded = !expanded" :aria-expanded="expanded">
                                        <svg width="8" height="12" viewBox="0 0 8 12" fill="none" aria-hidden="true" class="transition-all" :class="expanded ? 'rotate-90' : ''">
                                            <path d="M1.70706 11.707L7.41406 6.00003L1.70706 0.293031L0.293062 1.70703L4.58606 6.00003L0.293063 10.293L1.70706 11.707Z" fill="white"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-span-9">
                                    <div class="uppercase cursor-pointer" x-on:click="expanded = !expanded" :aria-expanded="expanded">{{$activity['title']}}</div>
                                    <div class="py-3 opacity-60" x-show="expanded" x-collapse>{!! $activity['content'] !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
