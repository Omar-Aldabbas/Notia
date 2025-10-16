<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NOTIA: ART & LIFE')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <a href="{{ route('home') }}" class="logo">NOTIA</a>
            <nav class="nav">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('posts.magazine') }}">Magazine</a>
                <a href="{{ route('authors.index') }}">Authors</a>
                <a href="{{ route('podcast') }}">Podcast</a>
                @auth
                    <a href="{{ route('profile.edit') }}">{{ auth()->user()->name }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn">Login</a>
                    <a href="{{ route('register') }}" class="btn">Register</a>
                @endauth
            </nav> 
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container footer-container">
            <p>&copy; {{ date('Y') }} NOTIA. All rights reserved.</p>
            <p>Art, Culture, Lifestyle & Ideas — Connect, Discover, Explore</p>
        </div>
    </footer>
</body>
</html>
