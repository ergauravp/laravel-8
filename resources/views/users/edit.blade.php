@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<form 
    action="{{ route('users.update', ['user' => $user->id]) }}" 
    method="POST" 
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    <div class="row">

        <div class="col-4">

            <img src="{{ $user->image ? $user->image->url() : '' }}" class="img-thumbnail avatar">
            
            <div class="card mt-4">
                <div class="card-body">
                    <h6>Upload a different photo</h6>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>
            </div>

        </div>

        <div class="col-8">

            <div class="form-group">
                <label>{{ __("Name") }}</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <label>{{ __("Language") }}</label>
                <select name="locale" id="locale" class="form-control">
                    @foreach (App\Models\User::LOCALES as $locale => $label)
                        <option value="{{ $locale }}" {{ $user->locale == $locale ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>            

            <x-errors></x-errors>

            <div class="form-group mt-2">
                <input type="submit" value="Save Changes" class="btn btn-primary">
            </div>

        </div>

    </div>

</form>

@endsection