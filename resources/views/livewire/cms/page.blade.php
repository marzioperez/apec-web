<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'banner')
            <x-blocks.banner :data="$block['data']" />
        @endif

        @if($block['type'] === 'progress')
            @if(auth()->check())
                <x-blocks.progress :data="$block['data']" />
            @endif
       @endif

        @if($block['type'] === 'block-1')
            <x-blocks.block-1 :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-2')
            <x-blocks.block-2 :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-3')
            <x-blocks.block-3 :data="$block['data']" />
       @endif

        @if($block['type'] === 'program')
            <livewire:common.program :data="$block['data']" />
        @endif

        @if($block['type'] === 'circular-progress')
            @if(auth()->check())
                <x-blocks.circular-progress :data="$block['data']" />
            @endif
        @endif

        @if($block['type'] === 'hotels')
            @if(auth()->check())
                <livewire:common.hotels :data="$block['data']" />
            @endif
        @endif

        @if($block['type'] === 'speakers')
            <livewire:common.speakers :data="$block['data']" />
        @endif

        @if($block['type'] === 'sponsors')
            <livewire:common.sponsors :data="$block['data']" />
        @endif

        @if($block['type'] === 'news')
            <livewire:common.news :data="$block['data']" />
        @endif
    @endforeach
</div>
