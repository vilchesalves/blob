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
</div>
@endsection
