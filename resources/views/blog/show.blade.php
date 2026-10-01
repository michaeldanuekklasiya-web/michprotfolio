@extends('layouts.site')

@section('title', $post->title.' — '.config('portfolio.short_name'))
@section('description', $post->summary)
@if ($post->cover_url)
    @section('og_image', $post->cover_url)
@endif

@section('content')
<article>
    <div class="container">
        <header class="article article-head">
            <a href="{{ route('blog.index') }}" class="eyebrow link-underline">Journal</a>
            <h1>{{ $post->title }}</h1>
            <div class="article-meta">
                <span>By {{ config('portfolio.short_name') }}</span>
                <span>·</span>
                <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('F d, Y') }}</time>
                <span>·</span>
                <span>{{ $post->reading_minutes }} min read</span>
                @if ($post->category)<span>·</span><span>{{ $post->category }}</span>@endif
            </div>
        </header>

        @if ($post->cover_url)
            <figure class="article-cover" style="max-width:1080px; margin-inline:auto; margin-bottom:56px">
                <img src="{{ $post->cover_url }}" alt="" width="1600" height="900" fetchpriority="high">
            </figure>
        @endif

        <div class="article prose">
            {!! $post->body_html !!}
        </div>

        <div class="article share">
            <span>Share</span>
            <a class="btn btn-ghost btn-sm" target="_blank" rel="noopener"
               href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}">LinkedIn</a>
            <a class="btn btn-ghost btn-sm" target="_blank" rel="noopener"
               href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}">X / Twitter</a>
            <a class="btn btn-ghost btn-sm" target="_blank" rel="noopener"
               href="https://wa.me/?text={{ urlencode($post->title.' '.request()->url()) }}">WhatsApp</a>
        </div>
    </div>
</article>

@if ($related->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="section-head">
            <h2 class="h2">Keep <i>reading</i>.</h2>
        </div>
        <div class="post-grid">
            @foreach ($related as $i => $item)
                @include('blog._card', ['post' => $item, 'delay' => $i * .1])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
