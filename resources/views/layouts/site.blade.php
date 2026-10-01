<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('portfolio.name').' — '.config('portfolio.role'))</title>
    <meta name="description" content="@yield('description', 'Product Designer & Visual Developer based in Indonesia — UI/UX, web development and brand identity.')">
    <meta property="og:title" content="@yield('title', config('portfolio.name'))">
    <meta property="og:description" content="@yield('description', config('portfolio.role'))">
    <meta property="og:image" content="@yield('og_image', asset('img/opt/mich.webp'))">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#f5f4f0">
    <link rel="icon" type="image/png" href="{{ asset('img/opt/fav.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
    <script>document.documentElement.classList.replace('no-js', 'js');</script>
    @stack('head')
</head>
<body>
    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.contact')

    <button class="to-top" type="button" aria-label="Back to top">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>

    <script src="{{ asset('js/site.js') }}?v={{ filemtime(public_path('js/site.js')) }}" defer></script>
</body>
</html>
