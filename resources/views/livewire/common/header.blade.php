<header>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <div>
                <a href="{{config('app.url')}}">
                    <img src="{{asset('img/logo-apec.svg')}}" class="logo" alt="{{config('app.name')}}" />
                </a>
            </div>

            <div class="hidden lg:flex lg:gap-x-6">
                @foreach($menu_items as $item)
                    @php
                        $show = true;
                        if ($item['only_logged']) {
                            $show = auth()->check();
                        }
                    @endphp
                    @if($show)
                        @if($item['type'] === \App\Concerns\Enums\Types::ANCHOR->value)
                            <a href="{{config('app.url')}}#{{$item['url']}}" class="text-sm font-semibold leading-6 text-gray-900">{{$item['name']}}</a>
                        @endif
                        @if($item['type'] === \App\Concerns\Enums\Types::URL->value)
                            <a href="{{$item['url']}}" class="text-sm font-semibold leading-6 text-gray-900">{{$item['name']}}</a>
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="flex items-center justify-end sm:space-x-4 space-x-2">
                @if($is_logged_in)
                    <div class="relative" x-data="{
                    open_user_menu: false,
                    toggle() {
                        if (this.open_user_menu) {
                            return this.close()
                        }
                        this.$refs.button.focus()
                        this.open_user_menu = true
                    },
                    close(focusAfter) {
                        if (!this.open_user_menu) return
                        this.open_user_menu = false
                        focusAfter && focusAfter.focus()
                    }
                }">
                        <button type="button" class="btn-user" id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                                x-ref="button"
                                x-on:click="toggle()"
                                :aria-expanded="open_user_menu"
                                :aria-controls="$id('dropdown-button')">
                            <div class="flex items-center">
                                <div class="flex sm:ml-3 font-semibold text-gray space-x-2">
                                    <div class="flex items-center space-x-3">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1109_2645)">
                                                <path d="M18.5104 14.9896C17.5846 14.0638 16.4827 13.3785 15.2804 12.9636C16.5681 12.0767 17.4141 10.5924 17.4141 8.91406C17.4141 6.20445 15.2096 4 12.5 4C9.79039 4 7.58594 6.20445 7.58594 8.91406C7.58594 10.5924 8.43192 12.0767 9.71964 12.9636C8.51735 13.3785 7.41541 14.0638 6.4896 14.9896C4.88417 16.595 4 18.7296 4 21H5.32812C5.32812 17.0454 8.54541 13.8281 12.5 13.8281C16.4546 13.8281 19.6719 17.0454 19.6719 21H21C21 18.7296 20.1158 16.595 18.5104 14.9896ZM12.5 12.5C10.5227 12.5 8.91406 10.8914 8.91406 8.91406C8.91406 6.93675 10.5227 5.32812 12.5 5.32812C14.4773 5.32812 16.0859 6.93675 16.0859 8.91406C16.0859 10.8914 14.4773 12.5 12.5 12.5Z" fill="black"/>
                                            </g>
                                            <circle cx="12.5" cy="12.5" r="12" stroke="black"/>
                                            <defs>
                                                <clipPath id="clip0_1109_2645">
                                                    <rect width="17" height="17" fill="white" transform="translate(4 4)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span class="sm:text-md text-sm">Hi, {{$name}}</span>
                                    </div>
                                </div>
                                <svg class="ml-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        <div class="absolute right-0 z-10 mt-2.5 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                             x-show="open_user_menu"
                             x-ref="panel"
                             x-on:click.outside="close($refs.button)"
                             :id="$id('dropdown-button')"
                             style="display: none;"
                             x-transition.origin.top.left>
                            <a href="{{route('progress')}}" class="block px-3 py-1 text-sm leading-6" role="menuitem" tabindex="-1" id="user-menu-item-1">Register</a>
                            @if(in_array(auth()->user()->status, [
                                \App\Concerns\Enums\Status::FINISHED->value,
                                \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value,
                                \App\Concerns\Enums\Status::PENDING_APPROVAL_DATA->value,
                                \App\Concerns\Enums\Status::PAYMENT_REVIEW->value,
                            ]))
                                <a href="{{route('hotel')}}" class="block px-3 py-1 text-sm leading-6" role="menuitem" tabindex="-1" id="user-menu-item-1">Flight and hotel</a>
                            @endif
                            @if(in_array(auth()->user()->status, [
                                \App\Concerns\Enums\Status::FINISHED->value,
                                \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value
                            ]))
                                <a href="{{route('qr')}}" class="block px-3 py-1 text-sm leading-6" role="menuitem" tabindex="-1" id="user-menu-item-1">My QR</a>
                            @endif
                            <button type="button" wire:click.prevent="logout" class="block px-3 py-1 text-sm leading-6" role="menuitem" tabindex="-1" id="user-menu-item-1">Log out</button>
                        </div>
                    </div>
                @else
                    <a href="{{route('login')}}" class="btn btn-secondary">Login</a>
                @endif

                <div class="flex lg:hidden">
                    <button type="button" x-on:click="$dispatch('toggle-menu-mobile')" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
