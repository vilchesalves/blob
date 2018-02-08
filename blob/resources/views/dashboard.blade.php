@extends('bootstrap')

@section('content')
<div class="blog-post">
    <ul>
        <li><a href="{{ route('post.new') }}">New post</a></li>
    </ul>
</div>
@endsection
