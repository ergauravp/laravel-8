<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" id="title" value="{{ old('title',optional($post ?? null)->title) }}">
</div>
{{-- @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

<div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content">{{ old('content',optional($post ?? null)->content) }}</textarea>
</div>
{{-- @error('content')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}

<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input class="form-control" type="file" name="thumbnail" id="thumbnail" />
</div>

<x-errors></x-errors>
