@extends('admin.layout')

@section('title', 'Pesan Masuk')

@section('content')
<div class="topbar">
    <div>
        <h1>Pesan Masuk</h1>
        <p>Dikirim lewat form “Let's talk” di website.</p>
    </div>
</div>

<div class="card">
    @if ($messages->isEmpty())
        <div class="empty">Belum ada pesan.</div>
    @else
        <ul class="list">
            @foreach ($messages as $msg)
                <li>
                    <span class="dot" style="{{ $msg->read_at ? 'visibility:hidden' : '' }}" title="Belum dibaca"></span>
                    <a class="grow" href="{{ route('admin.messages.show', $msg) }}">
                        <span class="title" style="{{ $msg->read_at ? 'font-weight:400' : '' }}">{{ $msg->subject }}</span>
                        <span class="sub">{{ $msg->name }} &lt;{{ $msg->email }}&gt; — {{ \Illuminate\Support\Str::limit($msg->message, 80) }}</span>
                    </a>
                    <span class="muted" style="font-size:13px; white-space:nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
        @if ($messages->hasPages())
            <div class="pager">
                <span>Halaman {{ $messages->currentPage() }} dari {{ $messages->lastPage() }}</span>
                <span style="display:flex; gap:6px">
                    @if (! $messages->onFirstPage())<a class="btn btn-ghost btn-sm" href="{{ $messages->previousPageUrl() }}">← Sebelumnya</a>@endif
                    @if ($messages->hasMorePages())<a class="btn btn-ghost btn-sm" href="{{ $messages->nextPageUrl() }}">Berikutnya →</a>@endif
                </span>
            </div>
        @endif
    @endif
</div>
@endsection
