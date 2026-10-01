<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · Admin MDE</title>
    <link rel="icon" type="image/png" href="{{ asset('img/opt/fav.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
@php
    $unread = \App\Models\Message::whereNull('read_at')->count();
    $nav = [
        ['admin.dashboard', 'admin.dashboard', 'Dashboard', '<path d="M3 13h8V3H3zM13 21h8V11h-8zM3 21h8v-6H3zM13 3v6h8V3z"/>'],
        ['admin.posts.index', 'admin.posts.*', 'Artikel Blog', '<path d="M4 4h16v16H4zM8 8h8M8 12h8M8 16h5"/>'],
        ['admin.projects.index', 'admin.projects.*', 'Portfolio', '<path d="M3 7h18v13H3zM8 7V4h8v3"/>'],
        ['admin.messages.index', 'admin.messages.*', 'Pesan Masuk', '<path d="M4 5h16v14H4zM4 6l8 7 8-7"/>'],
        ['admin.account', 'admin.account*', 'Akun', '<circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 4.5-6 8-6s6.5 2 8 6"/>'],
    ];
@endphp
<div class="shell">
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">MD<i>E</i><small>Admin</small></a>
        <nav class="side-nav">
            @foreach ($nav as [$route, $pattern, $label, $icon])
                <a href="{{ route($route) }}" @class(['is-active' => request()->routeIs($pattern)])>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round">{!! $icon !!}</svg>
                    {{ $label }}
                    @if ($route === 'admin.messages.index' && $unread)<span class="pill">{{ $unread }}</span>@endif
                </a>
            @endforeach
        </nav>
        <div class="side-foot">
            <a href="{{ url('/') }}" target="_blank">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M7 17 17 7M8 7h9v9"/></svg>
                Lihat website
            </a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M15 4h4v16h-4M10 8l-4 4 4 4M6 12h10"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        @if (session('status'))
            <div class="alert" role="status">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m5 12 5 5L20 7"/></svg>
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error" role="alert">Periksa kembali isian yang ditandai.</div>
        @endif

        @yield('content')

        <div class="mobile-actions" style="margin-top:40px">
            <a class="btn btn-ghost btn-sm" href="{{ url('/') }}" target="_blank">Lihat website ↗</a>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-ghost btn-sm" type="submit">Keluar</button></form>
        </div>
    </main>
</div>

<script>
    // Confirm destructive actions
    document.querySelectorAll('form[data-confirm]').forEach((f) => f.addEventListener('submit', (e) => {
        if (!confirm(f.dataset.confirm)) e.preventDefault();
    }));
</script>
@stack('scripts')
</body>
</html>
