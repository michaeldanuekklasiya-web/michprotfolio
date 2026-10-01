@extends('admin.layout')

@section('title', $project->exists ? 'Edit project' : 'Tambah project')

@section('content')
<div class="topbar">
    <div>
        <h1>{{ $project->exists ? 'Edit project' : 'Tambah project' }}</h1>
        <p><a href="{{ route('admin.projects.index') }}" class="muted">← Semua project</a></p>
    </div>
</div>

<form method="POST" enctype="multipart/form-data"
      action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}">
    @csrf
    @if ($project->exists) @method('PUT') @endif

    <div class="form-grid">
        <div class="card card-pad">
            <div @class(['field field-title', 'has-error' => $errors->has('title')])>
                <label for="title">Nama project</label>
                <input id="title" type="text" name="title" value="{{ old('title', $project->title) }}" required maxlength="150">
                @error('title')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:0 16px">
                <div @class(['field', 'has-error' => $errors->has('category')])>
                    <label for="category">Kategori</label>
                    <select id="category" name="category">
                        @foreach (\App\Models\Project::CATEGORIES as $key => $label)
                            <option value="{{ $key }}" @selected(old('category', $project->category) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div @class(['field', 'has-error' => $errors->has('client')])>
                    <label for="client">Klien <span class="muted">(opsional)</span></label>
                    <input id="client" type="text" name="client" value="{{ old('client', $project->client) }}">
                </div>
                <div @class(['field', 'has-error' => $errors->has('year')])>
                    <label for="year">Tahun <span class="muted">(opsional)</span></label>
                    <input id="year" type="text" name="year" value="{{ old('year', $project->year) }}" placeholder="2025">
                </div>
            </div>

            <div @class(['field', 'has-error' => $errors->has('description')])>
                <label for="description">Deskripsi singkat</label>
                <textarea id="description" name="description" rows="4" maxlength="1000">{{ old('description', $project->description) }}</textarea>
                @error('description')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div @class(['field', 'has-error' => $errors->has('tags')])>
                <label for="tags">Tools / teknologi</label>
                <input id="tags" type="text" name="tags" value="{{ old('tags', collect($project->tags)->join(', ')) }}" placeholder="Laravel, Tailwind, Figma">
                <span class="hint">Pisahkan dengan koma.</span>
            </div>

            <div @class(['field', 'has-error' => $errors->has('url')])>
                <label for="url">Link project <span class="muted">(opsional)</span></label>
                <input id="url" type="url" name="url" value="{{ old('url', $project->url) }}" placeholder="https://…">
                @error('url')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-side" style="display:grid; gap:16px">
            <div class="card card-pad">
                <label class="switch field">
                    <span class="label">Tampilkan di website</span>
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $project->is_published))>
                </label>
                <div @class(['field', 'has-error' => $errors->has('sort_order')])>
                    <label for="sort_order">Urutan</label>
                    <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}">
                    <span class="hint">Angka kecil tampil lebih dulu.</span>
                </div>
                <button class="btn btn-block" type="submit" style="height:46px">{{ $project->exists ? 'Simpan perubahan' : 'Simpan project' }}</button>
            </div>

            <div class="card card-pad">
                <div @class(['field', 'has-error' => $errors->has('image_file')])>
                    <span class="label">Gambar project</span>
                    <label class="dropzone">
                        <img id="image-preview" src="{{ $project->image_url }}" alt="" @if (! $project->image_url) hidden @endif>
                        <span>Klik untuk pilih gambar<br><small>Rasio 4:3 paling pas — otomatis dikompres</small></span>
                        <input type="file" name="image_file" accept="image/*" data-preview="image-preview">
                    </label>
                    @error('image_file')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.querySelectorAll('[data-preview]').forEach((input) => input.addEventListener('change', () => {
    const img = document.getElementById(input.dataset.preview);
    if (input.files[0]) { img.src = URL.createObjectURL(input.files[0]); img.hidden = false; }
}));
</script>
@endpush
