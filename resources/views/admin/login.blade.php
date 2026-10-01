<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Login · Admin MDE</title>
    <link rel="icon" type="image/png" href="{{ asset('img/opt/fav.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
<div class="auth">
    <div class="auth-art" aria-hidden="true">
        <img src="{{ asset('img/opt/float-cog.webp') }}" alt="" style="width:300px; top:10%; right:8%">
        <img src="{{ asset('img/opt/float-noodle.webp') }}" alt="" style="width:160px; top:42%; left:12%; animation-delay:-3s">
        <img src="{{ asset('img/opt/float-star.webp') }}" alt="" style="width:90px; top:16%; left:30%; animation-delay:-5s">
        <h2>Studio <i>control</i><br>room.</h2>
        <p>Kelola artikel, portfolio, dan pesan dari satu tempat.</p>
    </div>

    <div class="auth-form">
        <div class="box">
            <a href="{{ url('/') }}" class="brand" style="color:var(--ink); padding:0">MD<i>E</i></a>
            <h1>Selamat datang.</h1>
            <p class="muted" style="margin-bottom:28px">Masuk untuk mengelola website Anda.</p>

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf
                <div @class(['field', 'has-error' => $errors->has('email')])>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                </div>
                <label class="check" style="margin:4px 0 24px">
                    <input type="checkbox" name="remember" value="1"> Ingat saya di perangkat ini
                </label>
                <button class="btn btn-block" type="submit" style="height:48px">Masuk</button>
            </form>

            <p style="margin-top:28px"><a href="{{ url('/') }}" class="muted">← Kembali ke website</a></p>
        </div>
    </div>
</div>
</body>
</html>
