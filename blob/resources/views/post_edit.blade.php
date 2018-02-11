@extends('bootstrap')

@section('content')
<div class="blog-post">
    <form method="POST" action="{{ route('post.edit', [ 'id' => $post->_id]) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="title">Post title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="body">Post body</label>
            <textarea class="form-control" id="body" name="body" rows="3">{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Post</button>
    </form>
</div>
@endsection
