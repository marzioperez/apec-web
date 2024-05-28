@props(['post', 'style' => 1])
<a href="{{route('post', ['slug' => $post->slug])}}" class="post-item style-{{$style}}">
    <div class="cover">
        <img src="{{url('storage/web/' . $post->image)}}" alt="{{ $post->title }}">
        <div class="title">{{$post->title}}</div>
    </div>
</a>
