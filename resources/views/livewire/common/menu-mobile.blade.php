<div x-data="{
    open_mobile: false,
        toggle_mobile() {
            if(this.open_mobile) {
                return this.close_mobile();
            } else {
                this.open_mobile = true
            }
        },
        close_mobile() {
            if(!this.open_mobile) return
                this.open_mobile = false
            }
        }"
     x-on:toggle-menu-mobile.window="toggle_mobile()">
    <div role="dialog" aria-modal="true" x-show="open_mobile"
         x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
         x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
         class="fixed right-0 h-full z-20">
        <div class="fixed h-full w-full bg-gray-800/60 left-0 -z-10" x-show="open_mobile" x-on:click="toggle_mobile()"></div>
        <div class="flow-root px-6 py-3 bg-white h-full w-[250px]">
            <div class="divide-y divide-gray-500/10">
                <div class="space-y-2 py-2">
                    @foreach($menu_items as $item)
                        @php
                            $show = true;
                            if ($item['only_logged']) {
                                $show = auth()->check();
                            }
                        @endphp
                        @if($show)
                            @if($item['type'] === \App\Concerns\Enums\Types::ANCHOR->value)
                                <a href="{{config('app.url')}}#{{$item['url']}}" x-on:click="toggle_mobile()" class="text-sm font-semibold leading-6 text-gray-900">{{$item['name']}}</a>
                            @endif
                            @if($item['type'] === \App\Concerns\Enums\Types::URL->value)
                                <a href="{{$item['url']}}" class="text-sm font-semibold leading-6 text-gray-900">{{$item['name']}}</a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
