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
            <label for="datetime">Date</label>
            <div class="form-inline">
                <input id="date" class="form-control mr-sm-2" type="date" id="date" name="date" value="{{ $post->date->format('Y-m-d') }}">
                <input id="time" class="form-control" type="time" id="time" name="time" value="{{ $post->date->format('H:i:s') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $post->author }}">
        </div>
        <div class="form-group">
            <label for="body">Post body</label>
            <textarea class="form-control" id="body" name="body" rows="3">{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Post</button>
    </form>
</div>
@endsection
