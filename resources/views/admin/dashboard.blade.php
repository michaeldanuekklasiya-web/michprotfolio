@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="topbar">
    <div>
        <h1>Halo, {{ strtok(auth()->user()->name, ' ') }}.</h1>
        <p>Ringkasan website Anda hari ini.</p>
    </div>
    <div style="display:flex; gap:8px; flex-wrap:wrap">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-ghost">+ Project</a>
        <a href="{{ route('admin.posts.create') }}" class="btn">+ Tulis artikel</a>
    </div>
</div>

<div class="stats">
    <div class="card stat dark">
        <div class="num">{{ $stats['posts'] }}</div>
        <div class="label">Artikel ({{ $stats['published'] }} terbit)</div>
    </div>
    <div class="card stat">
        <div class="num">{{ $stats['projects'] }}</div>
        <div class="label">Project portfolio</div>
    </div>
    <div class="card stat">
        <div class="num">{{ $stats['unread'] }}</div>
        <div class="label">Pesan belum dibaca</div>
    </div>
    <div class="card stat">
        <div class="num">{{ $stats['likes'] }}</div>
        <div class="label">Like website</div>
    </div>
</div>

<div class="grid-2">
    <section class="card">
        <div class="card-head">
            <h2>Artikel terbaru</h2>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-ghost btn-sm">Semua</a>
        </div>
        @if ($recentPosts->isEmpty())
            <div class="empty">Belum ada artikel. <a href="{{ route('admin.posts.create') }}" style="text-decoration:underline">Tulis yang pertama</a>.</div>
        @else
            <ul class="list">
                @foreach ($recentPosts as $post)
                    <li>
                        <div class="grow">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="title">{{ $post->title }}</a>
                            <span class="sub">Diubah {{ $post->updated_at->diffForHumans() }}</span>
                        </div>
                        <span @class(['badge', 'on' => $post->is_published])>{{ $post->is_published ? 'Terbit' : 'Draft' }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="card">
        <div class="card-head">
            <h2>Pesan masuk</h2>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-ghost btn-sm">Semua</a>
        </div>
        @if ($recentMessages->isEmpty())
            <div class="empty">Belum ada pesan dari form kontak.</div>
        @else
            <ul class="list">
                @foreach ($recentMessages as $msg)
                    <li>
                        @if (! $msg->read_at)<span class="dot" title="Belum dibaca"></span>@endif
                        <div class="grow">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="title">{{ $msg->subject }}</a>
                            <span class="sub">{{ $msg->name }} · {{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
