@extends('layouts.app')

@section('title', 'Update the Post')

@section('content')

<form action="{{ route('posts.update', ['post'=> $post->id]) }}" method="post"  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('posts.partials.form')
    <div>
        <input type="submit" value="Update" class="btn btn-primary btn-block  mt-2">
    </div>
</form>
    
@endsection