@extends('admin.layout')

@section('title', 'Portfolio')

@section('content')
<div class="topbar">
    <div>
        <h1>Portfolio</h1>
        <p>{{ $projects->count() }} project · diurutkan berdasarkan kolom “Urutan”</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn">+ Tambah project</a>
</div>

<div class="card">
    @if ($projects->isEmpty())
        <div class="empty">Belum ada project.</div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Project</th><th>Kategori</th><th>Status</th><th>Urutan</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:12px; min-width:240px">
                                    @if ($project->image_url)
                                        <img class="thumb" src="{{ $project->image_url }}" alt="" loading="lazy">
                                    @else
                                        <span class="thumb"></span>
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.projects.edit', $project) }}" style="font-weight:500">{{ $project->title }}</a>
                                        <div class="muted" style="font-size:13px">{{ collect($project->tags)->join(', ') ?: '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="muted" style="white-space:nowrap">{{ $project->category_label }}</td>
                            <td><span @class(['badge', 'on' => $project->is_published])>{{ $project->is_published ? 'Tampil' : 'Disembunyikan' }}</span></td>
                            <td class="muted">{{ $project->sort_order }}</td>
                            <td>
                                <div class="actions">
                                    @if ($project->url)
                                        <a class="btn btn-ghost btn-sm" href="{{ $project->url }}" target="_blank" rel="noopener">Buka</a>
                                    @endif
                                    <a class="btn btn-ghost btn-sm" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Hapus project “{{ $project->title }}”?">
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
    @endif
</div>
@endsection
