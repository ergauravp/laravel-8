@extends('layouts.app')

@section('title', 'Create the Post')

@section('content')

<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('posts.partials.form')
    <div>
        <input type="submit" value="Create" class="btn btn-primary btn-block mt-2">
    </div>
</form>
    
@endsection