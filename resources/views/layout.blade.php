<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-1/css/all.css" rel="stylesheet">

</head>
<body>
    <div id="app" class="d-flex flex-column h-screen justify-content-between">
        <header>
        @include('partials.nav')
        @include('partials.session-status')    
    </header>

    <main class="py-4">    
        @yield('content')
    </main>

    <footer class="bg-white text-center text-black-50 py-2 shadow">
        <a href="{{ route('home') }}"><h4 class="text-primary navbar-brand">{{ config('app.name') }} | Copyright @ {{ date('yy') }}</h2></a>
        <div class="justify-content-between align-items-center">
            <a href="https://www.facebook.com/"><i class="social facebook fab fa-facebook fa-2x"></i></a>
            <a href="https://www.instagram.com/"><i class="social instagram fab fa-instagram fa-2x"></i></a>
            <a href="https://www.twitter.com/"><i class="social twitter fab fa-twitter fa-2x"></i></a>
        </div>
    </footer>
    </div>
</body>
</html>