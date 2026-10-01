@extends('admin.layout')

@section('title', $message->subject)

@section('content')
<div class="topbar">
    <div>
        <h1>{{ $message->subject }}</h1>
        <p><a href="{{ route('admin.messages.index') }}" class="muted">← Semua pesan</a></p>
    </div>
    <div style="display:flex; gap:8px">
        <a class="btn" href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}">Balas via email</a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="Hapus pesan ini?">
            @csrf @method('DELETE')
            <button class="btn btn-danger" type="submit">Hapus</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h2>{{ $message->name }}</h2>
            <span class="muted" style="font-size:13px">{{ $message->email }}</span>
        </div>
        <span class="muted" style="font-size:13px">{{ $message->created_at->format('d M Y, H:i') }}</span>
    </div>
    <div class="card-pad message-body">{{ $message->message }}</div>
</div>
@endsection
