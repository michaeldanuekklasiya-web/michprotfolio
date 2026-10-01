<a href="{{ route('blog.show', $post->slug) }}" class="post-card" data-reveal style="--rd:{{ $delay ?? 0 }}s">
    @if ($post->cover_url)
        <div class="media"><img src="{{ $post->cover_url }}" alt="" loading="lazy" decoding="async" width="1600" height="1000"></div>
    @else
        <div class="media placeholder" aria-hidden="true">{{ mb_substr($post->title, 0, 1) }}</div>
    @endif
    <div class="meta">
        @if ($post->category)<span>{{ $post->category }}</span><span>·</span>@endif
        <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('M d, Y') }}</time>
        <span>·</span><span>{{ $post->reading_minutes }} min read</span>
    </div>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->summary }}</p>
</a>
