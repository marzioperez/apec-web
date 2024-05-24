<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'banner')
            <x-blocks.banner :data="$block['data']" />
        @endif
    @endforeach
</div>
