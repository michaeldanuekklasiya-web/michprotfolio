@extends('admin.layout')

@section('title', $post->exists ? 'Edit artikel' : 'Tulis artikel')

@section('content')
<div class="topbar">
    <div>
        <h1>{{ $post->exists ? 'Edit artikel' : 'Tulis artikel' }}</h1>
        <p><a href="{{ route('admin.posts.index') }}" class="muted">← Semua artikel</a></p>
    </div>
    @if ($post->exists && $post->is_published)
        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-ghost">Lihat di website ↗</a>
    @endif
</div>

<form method="POST" enctype="multipart/form-data"
      action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="form-grid">
        <div class="card card-pad">
            <div @class(['field field-title', 'has-error' => $errors->has('title')])>
                <label for="title">Judul</label>
                <input id="title" type="text" name="title" value="{{ old('title', $post->title) }}" required maxlength="200" placeholder="Judul artikel">
                @error('title')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div @class(['field', 'has-error' => $errors->has('slug')])>
                <label for="slug">Slug URL</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="otomatis dari judul">
                <span class="hint">{{ url('/blog') }}/<b id="slug-preview">{{ old('slug', $post->slug) ?: '…' }}</b></span>
                @error('slug')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div @class(['field', 'has-error' => $errors->has('body')])>
                <label for="body">Isi artikel</label>
                <div class="editor">
                    <div class="toolbar" role="toolbar" aria-label="Format">
                        <button type="button" data-md="## " data-line title="Heading"><b>H2</b></button>
                        <button type="button" data-md="### " data-line title="Sub-heading"><b>H3</b></button>
                        <span class="sep"></span>
                        <button type="button" data-wrap="**" title="Tebal"><b>B</b></button>
                        <button type="button" data-wrap="_" title="Miring"><i>I</i></button>
                        <button type="button" data-link title="Link">Link</button>
                        <span class="sep"></span>
                        <button type="button" data-md="- " data-line title="Daftar">• List</button>
                        <button type="button" data-md="1. " data-line title="Daftar bernomor">1. List</button>
                        <button type="button" data-md="> " data-line title="Kutipan">“ Quote</button>
                        <button type="button" data-wrap="`" title="Kode">&lt;/&gt;</button>
                        <button type="button" data-image title="Gambar dari URL">Gambar</button>
                    </div>
                    <textarea id="body" name="body" required placeholder="Tulis dengan Markdown…&#10;&#10;## Sub judul&#10;Paragraf biasa, **tebal**, _miring_, [link](https://…)">{{ old('body', $post->body) }}</textarea>
                </div>
                <span class="hint">Format Markdown. Baris kosong = paragraf baru.</span>
                @error('body')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-side" style="display:grid; gap:16px">
            <div class="card card-pad">
                <label class="switch field">
                    <span>
                        <span class="label">Terbitkan</span><br>
                        <span class="hint muted" style="font-size:12px">Matikan untuk simpan sebagai draft</span>
                    </span>
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published))>
                </label>
                <div @class(['field', 'has-error' => $errors->has('published_at')])>
                    <label for="published_at">Tanggal terbit</label>
                    <input id="published_at" type="datetime-local" name="published_at"
                           value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                    <span class="hint">Kosongkan = sekarang. Tanggal di masa depan = terjadwal.</span>
                    @error('published_at')<span class="error">{{ $message }}</span>@enderror
                </div>
                <button class="btn btn-block" type="submit" style="height:46px">{{ $post->exists ? 'Simpan perubahan' : 'Simpan artikel' }}</button>
            </div>

            <div class="card card-pad">
                <div @class(['field', 'has-error' => $errors->has('category')])>
                    <label for="category">Kategori</label>
                    <input id="category" type="text" name="category" value="{{ old('category', $post->category) }}" list="categories" placeholder="Design, Development…">
                    <datalist id="categories">
                        @foreach (\App\Models\Post::whereNotNull('category')->distinct()->pluck('category') as $cat)
                            <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                </div>
                <div @class(['field', 'has-error' => $errors->has('excerpt')])>
                    <label for="excerpt">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" rows="3" maxlength="400" placeholder="Muncul di kartu artikel & Google">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div @class(['field', 'has-error' => $errors->has('cover')])>
                    <span class="label">Gambar cover</span>
                    <label class="dropzone">
                        <img id="cover-preview" src="{{ $post->cover_url }}" alt="" @if (! $post->cover_url) hidden @endif>
                        <span>Klik untuk pilih gambar<br><small>JPG/PNG/WebP, maks 8MB — otomatis dikompres</small></span>
                        <input type="file" name="cover" accept="image/*" data-preview="cover-preview">
                    </label>
                    @if ($post->cover_image)
                        <label class="check"><input type="checkbox" name="remove_cover" value="1"> Hapus cover</label>
                    @endif
                    @error('cover')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(() => {
    const body = document.getElementById('body');
    const replace = (before, after = '', placeholder = '') => {
        const { selectionStart: s, selectionEnd: e, value } = body;
        const sel = value.slice(s, e) || placeholder;
        body.setRangeText(before + sel + after, s, e, 'end');
        if (!value.slice(s, e)) body.setSelectionRange(s + before.length, s + before.length + sel.length);
        body.focus();
    };
    document.querySelectorAll('.toolbar button').forEach((b) => b.addEventListener('click', () => {
        if (b.dataset.wrap) return replace(b.dataset.wrap, b.dataset.wrap, 'teks');
        if (b.hasAttribute('data-link')) return replace('[', '](https://)', 'teks link');
        if (b.hasAttribute('data-image')) return replace('![', '](https://alamat-gambar.jpg)', 'keterangan');
        if (b.hasAttribute('data-line')) {
            const lineStart = body.value.lastIndexOf('\n', body.selectionStart - 1) + 1;
            body.setRangeText(b.dataset.md, lineStart, lineStart, 'end');
            body.focus();
        }
    }));

    const slug = document.getElementById('slug'), title = document.getElementById('title'), preview = document.getElementById('slug-preview');
    const slugify = (t) => t.toLowerCase().normalize('NFKD').replace(/[̀-ͯ]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    const sync = () => preview.textContent = slug.value || slugify(title.value) || '…';
    title.addEventListener('input', sync); slug.addEventListener('input', sync);

    document.querySelectorAll('[data-preview]').forEach((input) => input.addEventListener('change', () => {
        const img = document.getElementById(input.dataset.preview);
        if (input.files[0]) { img.src = URL.createObjectURL(input.files[0]); img.hidden = false; }
    }));
})();
</script>
@endpush
