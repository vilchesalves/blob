@extends('bootstrap')

@section('content')

@foreach ($posts as $post)
<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">
    <a href="{{ route('post.show', [ 'id' => $post->_id ]) }}">{{ $post->date->format('F j, Y') }} by</a>
        {{ $post->author }}
    </p>
    <div class="body">
        {{ $post->body }}
    </div>
</div>
@endforeach

<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>

@endsection
