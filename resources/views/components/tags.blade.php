<p>
    @foreach($tags as $tag)
        <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" class="badge" style="background-color:green; font-size: 1rem;">{{ $tag->name }}</a>
    @endforeach
</p>