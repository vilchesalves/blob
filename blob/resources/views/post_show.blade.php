@extends('bootstrap')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">
        <a href="{{ route('post.show', [ 'id' => $post->_id ]) }}">January 1, 2014 by</a>
        Author
    </p>
    <div class="body">
        {{ $post->body }}
    </div>

    @auth
    <div class="admin">
        <ul>
            <li><a href="{{ route('post.edit', [ 'id' => $post->_id]) }}">edit post</a></li>
        </ul>
    </div>
    @endauth
</div>
@endsection
