@extends('layouts.site')

@section('title', 'Journal — '.config('portfolio.name'))
@section('description', 'Articles and notes on design, development and building digital products.')

@section('content')
<section class="page-head">
    <div class="container">
        <span class="eyebrow">Journal</span>
        <h1 class="display">
            <span class="split-line"><span>Notes on design</span></span>
            <span class="split-line"><span style="--ld:.08s">&amp; <span class="italic">craft.</span></span></span>
        </h1>

        @if ($categories->count() > 1)
            <div class="filters" style="margin-top:40px">
                <a class="chip {{ request('category') ? '' : 'is-active' }}" style="display:inline-grid;place-items:center" href="{{ route('blog.index') }}">All</a>
                @foreach ($categories as $cat)
                    <a class="chip {{ request('category') === $cat ? 'is-active' : '' }}" style="display:inline-grid;place-items:center"
                       href="{{ route('blog.index', ['category' => $cat]) }}">{{ $cat }}</a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section style="padding-bottom:120px">
    <div class="container">
        @if ($posts->isEmpty())
            <div class="empty">No articles yet — check back soon.</div>
        @else
            <div class="post-grid">
                @foreach ($posts as $i => $post)
                    @include('blog._card', ['post' => $post, 'delay' => ($i % 3) * .1])
                @endforeach
            </div>

            @if ($posts->hasPages())
                <nav class="pagination" aria-label="Pagination">
                    @if ($posts->onFirstPage())
                        <span class="is-disabled">←</span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" rel="prev" aria-label="Previous">←</a>
                    @endif
                    @foreach (range(1, $posts->lastPage()) as $page)
                        @if ($page === $posts->currentPage())
                            <span class="is-current">{{ $page }}</span>
                        @else
                            <a href="{{ $posts->url($page) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" rel="next" aria-label="Next">→</a>
                    @else
                        <span class="is-disabled">→</span>
                    @endif
                </nav>
            @endif
        @endif
    </div>
</section>
@endsection
