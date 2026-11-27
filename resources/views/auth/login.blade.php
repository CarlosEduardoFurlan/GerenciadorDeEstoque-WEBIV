@extends('template')

@section('conteudo')
    <div class="row justify-content-center"><div class="col-md-6 col-lg-5">
        <h1 class="h3 mb-4">Entrar</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-check mb-3">
                <input id="remember" name="remember" type="checkbox" class="form-check-input">
                <label for="remember" class="form-check-label">Manter conectado</label>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <div class="mt-3"><a href="{{ route('register') }}">Criar conta</a> · <a href="{{ route('password.request') }}">Esqueci minha senha</a></div>
    </div></div>
@endsection
