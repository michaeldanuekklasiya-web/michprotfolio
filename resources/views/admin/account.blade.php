@extends('admin.layout')

@section('title', 'Akun')

@section('content')
<div class="topbar">
    <div>
        <h1>Akun</h1>
        <p>Ubah nama, email login, atau password.</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.account.update') }}" class="card card-pad" style="max-width:560px">
    @csrf @method('PUT')

    <div @class(['field', 'has-error' => $errors->has('name')])>
        <label for="name">Nama</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name')<span class="error">{{ $message }}</span>@enderror
    </div>
    <div @class(['field', 'has-error' => $errors->has('email')])>
        <label for="email">Email login</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
        @error('email')<span class="error">{{ $message }}</span>@enderror
    </div>

    <hr style="border:0; border-top:1px solid var(--line); margin:24px 0">

    <div @class(['field', 'has-error' => $errors->has('password')])>
        <label for="password">Password baru <span class="muted">(kosongkan jika tidak diganti)</span></label>
        <input id="password" type="password" name="password" autocomplete="new-password" minlength="8">
        @error('password')<span class="error">{{ $message }}</span>@enderror
    </div>
    <div class="field">
        <label for="password_confirmation">Ulangi password baru</label>
        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
    </div>

    <hr style="border:0; border-top:1px solid var(--line); margin:24px 0">

    <div @class(['field', 'has-error' => $errors->has('current_password')])>
        <label for="current_password">Password saat ini</label>
        <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
        <span class="hint">Wajib diisi untuk menyimpan perubahan.</span>
        @error('current_password')<span class="error">{{ $message }}</span>@enderror
    </div>

    <button class="btn" type="submit" style="margin-top:8px">Simpan</button>
</form>
@endsection
