@php
    // On inner pages the section anchors live on the homepage.
    $base = request()->routeIs('home') ? '' : url('/');
    $links = ['about' => 'About', 'work' => 'Work', 'experience' => 'Experience'];
@endphp
<header class="site-header">
    <div class="container">
        <a href="{{ url('/') }}" class="logo" aria-label="Home">MD<i>E</i><span class="dot"></span></a>

        <nav class="nav" aria-label="Main">
            @foreach ($links as $id => $label)
                <a href="{{ $base }}#{{ $id }}">{{ $label }}</a>
            @endforeach
            <a href="{{ route('blog.index') }}" @class(['is-active' => request()->routeIs('blog.*')])>Journal</a>
        </nav>

        <div class="header-actions">
            <button class="like-btn" type="button" data-like aria-pressed="false" aria-label="Like this site">
                <svg viewBox="0 0 24 24"><path d="M12 20.4 4.3 12.7a4.5 4.5 0 0 1 6.4-6.4L12 7.6l1.3-1.3a4.5 4.5 0 0 1 6.4 6.4z"/></svg>
                <span class="count">0</span>
            </button>
            <a href="#contact" class="btn btn-dark btn-sm header-cta" data-contact>
                Let's talk
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M8 7h9v9"/></svg>
            </a>
            <button class="menu-btn" type="button" aria-label="Menu" aria-expanded="false" aria-controls="mobile-menu"><span></span></button>
        </div>
    </div>
</header>

<div class="mobile-menu" id="mobile-menu">
    <nav aria-label="Mobile">
        <a href="{{ url('/') }}">Home</a>
        @foreach ($links as $id => $label)
            <a href="{{ $base }}#{{ $id }}">{{ $label }}</a>
        @endforeach
        <a href="{{ route('blog.index') }}">Journal</a>
        <a href="#contact" data-contact><i>Let's talk</i></a>
    </nav>
    <div class="meta">
        @foreach (config('portfolio.socials') as $name => $url)
            @if ($url !== '#')<a href="{{ $url }}" target="_blank" rel="noopener">{{ $name }} ↗</a>@endif
        @endforeach
        <span>Based in {{ config('portfolio.location') }}</span>
    </div>
</div>
