@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')

<div class="row">
    <div class="col-8">
        @if (count($posts))
            @foreach ($posts as $key => $post)
                @include('posts.partials.post')
            @endforeach
        @else
            <div>No posts found.</div>
        @endif
    </div>
    <div class="col-4">
        @include('posts.partials.activity')
    </div>
</div>

@endsection