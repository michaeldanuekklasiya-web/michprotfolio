@extends('layouts.site')

@push('head')
    <link rel="preload" as="image" href="{{ asset('img/opt/float-cog.webp') }}">
@endpush

@section('content')
@php($p = config('portfolio'))

{{-- ============ HERO ============ --}}
<section class="hero" id="home">
    <div class="floaters" aria-hidden="true">
        <div class="floater f-cog" data-depth="0.5"><img src="{{ asset('img/opt/float-cog.webp') }}" alt="" width="360" height="360" fetchpriority="high"></div>
        <div class="floater f-star" data-depth="0.9"><img src="{{ asset('img/opt/float-star.webp') }}" alt="" width="260" height="260"></div>
        <div class="floater f-pyramid" data-depth="0.35"><img src="{{ asset('img/opt/float-pyramid.webp') }}" alt="" width="300" height="300"></div>
        <div class="floater f-noodle" data-depth="0.7"><img src="{{ asset('img/opt/float-noodle.webp') }}" alt="" width="360" height="360"></div>
        <div class="floater f-spring" data-depth="0.25"><img src="{{ asset('img/opt/float-spring.webp') }}" alt="" width="300" height="300"></div>
        <div class="floater f-tube" data-depth="0.6"><img src="{{ asset('img/opt/float-tube.webp') }}" alt="" width="300" height="300"></div>
    </div>

    <div class="container hero-inner">
        <span class="badge"><span class="pulse"></span> Available for new projects</span>

        <h1 class="display">
            <span class="split-line"><span>Building <span class="italic">digital</span></span></span>
            <span class="split-line"><span style="--ld:.08s">products, brands</span></span>
            <span class="split-line"><span style="--ld:.16s">&amp;
                <span class="avatar-inline"><img src="{{ asset('img/opt/mich.webp') }}" alt="{{ $p['short_name'] }}" width="640" height="480"></span>
                <span class="italic">experiences.</span></span></span>
        </h1>

        <div class="hero-bottom">
            <div>
                <p class="lead" data-reveal style="--rd:.3s">
                    Hi, I'm {{ $p['short_name'] }} — a {{ strtolower($p['role']) }} based in {{ $p['location'] }}, specializing in UI/UX design, responsive web and visual development.
                </p>
                <div class="hero-actions" data-reveal style="--rd:.4s; margin-top:28px">
                    <a href="#work" class="btn btn-dark">
                        View selected work
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M8 7h9v9"/></svg>
                    </a>
                    <a href="#contact" class="btn btn-ghost" data-contact>Start a project</a>
                </div>
            </div>
            <div class="scroll-cue" aria-hidden="true"><span class="line"></span> Scroll</div>
        </div>
    </div>
</section>

{{-- ============ CLIENTS ============ --}}
<section class="clients" aria-label="Clients">
    <div class="marquee" style="--speed:38s">
        @foreach ([false, true] as $clone)
            <div class="marquee-track" @if ($clone) aria-hidden="true" @endif>
                @foreach ($p['clients'] as $client)
                    <img src="{{ asset($client['logo']) }}" alt="{{ $clone ? '' : $client['name'] }}" loading="lazy" decoding="async" height="56" width="140">
                @endforeach
            </div>
        @endforeach
    </div>
</section>

{{-- ============ ABOUT ============ --}}
<section class="section" id="about">
    <div class="container">
        <div class="about-grid">
            <figure class="about-photo" data-reveal style="margin:0">
                <img src="{{ asset('img/opt/mich.webp') }}" alt="Portrait of {{ $p['name'] }}" width="640" height="480" loading="lazy" decoding="async">
                <figcaption class="tag">{{ $p['name'] }} — {{ $p['location'] }}</figcaption>
            </figure>

            <div class="about-copy">
                <span class="eyebrow" data-reveal>About</span>
                <p class="lead" data-reveal style="margin-top:24px">
                    I'm a product designer and visual developer with years of hands-on work across <em>design</em>, <em>code</em> and <em>brand</em>.
                    I combine creative thinking with technical depth to ship experiences that look refined and solve real problems.
                </p>

                <div class="stats" style="margin-top:56px">
                    @foreach ($p['stats'] as $i => $stat)
                        <div class="stat" data-reveal style="--rd:{{ $i * .08 }}s">
                            <div class="num" data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">{{ $stat['value'] }}{{ $stat['suffix'] }}</div>
                            <div class="label">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="services" style="margin-top:72px">
                    @foreach ($p['services'] as $service)
                        <div class="service" data-reveal>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ TOOLS ============ --}}
<section class="tools" aria-label="Tools and technologies">
    <div class="marquee marquee-reverse" style="--speed:60s">
        @foreach ([false, true] as $clone)
            <div class="marquee-track" @if ($clone) aria-hidden="true" @endif>
                @foreach ($p['tools'] as $tool)
                    <span>{{ $tool }}</span><i class="sep"></i>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

{{-- ============ WORK ============ --}}
<section class="section section-white" id="work">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow" data-reveal>Selected work</span>
                <h2 class="h2" data-reveal style="margin-top:20px">Projects that move <i>brands</i> forward.</h2>
            </div>
            @if ($projects->isNotEmpty())
                <div class="filters" role="group" aria-label="Filter projects" data-reveal>
                    <button class="chip is-active" type="button" data-filter="all" aria-pressed="true">All</button>
                    @foreach (\App\Models\Project::CATEGORIES as $key => $label)
                        @if ($projects->contains('category', $key))
                            <button class="chip" type="button" data-filter="{{ $key }}" aria-pressed="false">{{ $label }}</button>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        @if ($projects->isEmpty())
            <div class="empty">New projects are on the way.</div>
        @else
            <div class="work-grid">
                @foreach ($projects as $project)
                    @php($tag = $project->url ? 'a' : 'div')
                    <{{ $tag }} class="work-card" data-category="{{ $project->category }}" data-reveal
                        @if ($project->url) href="{{ $project->url }}" target="_blank" rel="noopener" @endif>
                        <div class="work-media">
                            @if ($project->image_url)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy" decoding="async" width="1200" height="900">
                            @endif
                            <span class="view">{{ $project->url ? 'Visit ↗' : 'View' }}</span>
                        </div>
                        <div class="work-meta">
                            <h3>{{ $project->title }}</h3>
                            <span class="cat">{{ $project->category_label }}@if ($project->year) · {{ $project->year }}@endif</span>
                        </div>
                        @if ($project->description)<p class="work-desc">{{ $project->description }}</p>@endif
                        @if ($project->tags)
                            <div class="tags">@foreach ($project->tags as $t)<span>{{ $t }}</span>@endforeach</div>
                        @endif
                    </{{ $tag }}>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============ EXPERIENCE ============ --}}
<section class="section section-dark" id="experience">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow" data-reveal>Experience</span>
                <h2 class="h2" data-reveal style="margin-top:20px">A path across <i>design</i> &amp; engineering.</h2>
            </div>
            <p class="lead" data-reveal style="max-width:34ch">From graphic design and marketing to full-stack and backend engineering.</p>
        </div>

        <div class="xp-list">
            @foreach ($p['experience'] as $i => $job)
                <details class="xp" data-reveal @if ($i === 0) open @endif>
                    <summary>
                        <span class="company">{{ $job['company'] }}</span>
                        <span class="role">{{ $job['role'] }}</span>
                        <span class="period">{{ $job['period'] }}</span>
                        <span class="plus" aria-hidden="true"></span>
                    </summary>
                    <div class="xp-body">
                        <span class="period-m">{{ $job['period'] }}</span>
                        <p>{{ $job['summary'] }}</p>
                        <ul>@foreach ($job['highlights'] as $h)<li>{{ $h }}</li>@endforeach</ul>
                        <div class="tags">@foreach ($job['stack'] as $s)<span>{{ $s }}</span>@endforeach</div>
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ TESTIMONIALS ============ --}}
@if (! empty($p['testimonials']))
<section class="section" id="testimonials">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow" data-reveal>Kind words</span>
                <h2 class="h2" data-reveal style="margin-top:20px">What clients <i>say</i>.</h2>
            </div>
        </div>
        <div class="quotes">
            @foreach ($p['testimonials'] as $i => $t)
                <figure class="quote" data-reveal style="margin:0; --rd:{{ $i * .1 }}s">
                    <blockquote>{{ $t['quote'] }}</blockquote>
                    <figcaption class="who">
                        <span class="initials">{{ collect(explode(' ', $t['name']))->map(fn ($w) => $w[0])->take(2)->join('') }}</span>
                        <span><b>{{ $t['name'] }}</b><small>{{ $t['role'] }}</small></span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ JOURNAL ============ --}}
@if ($posts->isNotEmpty())
<section class="section section-white" id="journal">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow" data-reveal>Journal</span>
                <h2 class="h2" data-reveal style="margin-top:20px">Notes on design &amp; <i>craft</i>.</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-ghost" data-reveal>
                All articles
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M8 7h9v9"/></svg>
            </a>
        </div>
        <div class="post-grid">
            @foreach ($posts as $i => $post)
                @include('blog._card', ['post' => $post, 'delay' => $i * .1])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ CTA ============ --}}
<section class="section section-dark cta">
    <div class="floaters" aria-hidden="true">
        <div class="floater f-a"><img src="{{ asset('img/opt/float-cylinder.webp') }}" alt="" width="300" height="300" loading="lazy"></div>
        <div class="floater f-b"><img src="{{ asset('img/opt/float-pyramid.webp') }}" alt="" width="300" height="300" loading="lazy"></div>
    </div>
    <div class="container" style="position:relative; z-index:2">
        <span class="eyebrow" data-reveal>Have a project in mind?</span>
        <h2 class="display" data-reveal>Let's build something <span class="italic">remarkable.</span></h2>
        <div data-reveal style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap">
            <a href="#contact" class="btn btn-light" data-contact>
                Start a project
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 17 17 7M8 7h9v9"/></svg>
            </a>
            <a href="{{ $p['socials']['LinkedIn'] }}" target="_blank" rel="noopener" class="btn btn-light" style="background:transparent;color:#fff;border-color:rgba(255,255,255,.3)">Connect on LinkedIn</a>
        </div>
    </div>
</section>
@endsection
