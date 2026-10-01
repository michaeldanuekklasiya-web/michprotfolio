@extends('admin.layout')

@section('title', 'Artikel Blog')

@section('content')
<div class="topbar">
    <div>
        <h1>Artikel Blog</h1>
        <p>{{ $posts->total() }} artikel</p>
    </div>
    <div style="display:flex; gap:8px; flex-wrap:wrap">
        <form class="search" method="GET">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari judul…" aria-label="Cari artikel">
        </form>
        <a href="{{ route('admin.posts.create') }}" class="btn">+ Tulis artikel</a>
    </div>
</div>

<div class="card">
    @if ($posts->isEmpty())
        <div class="empty">
            {{ request('q') ? 'Tidak ada artikel yang cocok.' : 'Belum ada artikel.' }}
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal terbit</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:12px; min-width:260px">
                                    @if ($post->cover_url)
                                        <img class="thumb" src="{{ $post->cover_url }}" alt="" loading="lazy">
                                    @else
                                        <span class="thumb"></span>
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.posts.edit', $post) }}" style="font-weight:500">{{ $post->title }}</a>
                                        <div class="muted" style="font-size:13px">/blog/{{ $post->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="muted">{{ $post->category ?: '—' }}</td>
                            <td>
                                @if ($post->is_published && $post->published_at?->isFuture())
                                    <span class="badge">Terjadwal</span>
                                @else
                                    <span @class(['badge', 'on' => $post->is_published])>{{ $post->is_published ? 'Terbit' : 'Draft' }}</span>
                                @endif
                            </td>
                            <td class="muted" style="white-space:nowrap">{{ $post->published_at?->format('d M Y') ?? '—' }}</td>
                            <td>
                                <div class="actions">
                                    @if ($post->is_published)
                                        <a class="btn btn-ghost btn-sm" href="{{ route('blog.show', $post->slug) }}" target="_blank">Lihat</a>
                                    @endif
                                    <a class="btn btn-ghost btn-sm" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" data-confirm="Hapus artikel “{{ $post->title }}”?">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="pager">
                <span>Halaman {{ $posts->currentPage() }} dari {{ $posts->lastPage() }}</span>
                <span style="display:flex; gap:6px">
                    @if (! $posts->onFirstPage())<a class="btn btn-ghost btn-sm" href="{{ $posts->previousPageUrl() }}">← Sebelumnya</a>@endif
                    @if ($posts->hasMorePages())<a class="btn btn-ghost btn-sm" href="{{ $posts->nextPageUrl() }}">Berikutnya →</a>@endif
                </span>
            </div>
        @endif
    @endif
</div>
@endsection
