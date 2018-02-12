@extends('bootstrap')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">
        <a href="{{ route('post.show', [ 'id' => $post->_id ]) }}">{{ $post->date->format('F j, Y') }} by</a>
        {{ $post->author }}
    </p>
    <div class="body">
        {{ $post->body }}
    </div>

    @auth
    <div class="admin">
        <h4>Admin</h4>
        <ul>
            <li><a href="{{ route('post.edit', [ 'id' => $post->_id]) }}">edit post</a></li>
            <li><a href="{{ route('post.destroy', [ 'id' => $post->_id]) }}">remove post</a></li>
        </ul>
    </div>
    @endauth
</div>
@endsection
