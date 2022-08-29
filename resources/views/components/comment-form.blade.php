<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" id="content"></textarea>
            </div>
            
            <div>
                <input type="submit" value="Create Comment" class="btn btn-primary btn-block mt-2">
            </div>
        </form>
        <x-errors></x-errors>
    @else
        <a href="{{ route('login') }}">Login</a> to post comment!
    @endauth
</div>
<hr/>