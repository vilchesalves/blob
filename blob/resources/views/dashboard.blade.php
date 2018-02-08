@extends('bootstrap')

@section('content')
<div class="blog-post">
    <ul>
        <li><a href="{{ route('post.create') }}">Create new post</a></li>
    </ul>
</div>
@endsection
