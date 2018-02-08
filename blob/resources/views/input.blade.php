@extends('bootstrap')

@section('content')
<div class="blog-post">
    <form method="POST" action="/posts/new">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Post title</label>
            <input type="text" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="body">Post body</label>
            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Post</button>
    </form>
</div>
@endsection
