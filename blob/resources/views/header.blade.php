<nav class="nav blog-nav">

    <a class="nav-link active" href="{{ route('index') }}">Home</a>
    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>

    @if (Route::has('login'))
        <div class="top-right links">
            <a class="nav-link" href="#">Input</a>
            @auth
                <a href="{{ route('index') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

</nav>
