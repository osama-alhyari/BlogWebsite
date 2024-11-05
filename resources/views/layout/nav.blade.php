<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('posts') }}">Dardos Blogs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                @auth
                @if(Auth::user()->is_admin)

                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('dashboard') }}">Dashboard</a></li>

                @endif
                @endauth
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('post.html') }}">Random Post</a></li>

                <!-- Check if user is logged in -->
                @auth
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}">Logout</a></li>
                @endauth

                <!-- Check if user is not logged in -->
                @guest
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('authentication') }}">Login</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>