<nav class="nav blog-nav">

    <a class="nav-link" href="{{ route('index') }}">Home</a>

    @auth
        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
    @else
        <a class="nav-link" href="{{ route('login') }}">Login</a>
        <a class="nav-link" href="{{ route('register') }}">Register</a>
    @endauth

</nav>
