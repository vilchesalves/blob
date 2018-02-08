@extends('bootstrap')

@section('content')
<div class="blog-post">
    <form method="POST" action="{{ route('post.destroy', ['id' => $id]) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <p>Confirm deletion of id {{ $id }}?</p>

        <button type="submit" class="btn btn-primary mb-2">Delete</button>
    </form>
</div>
@endsection
