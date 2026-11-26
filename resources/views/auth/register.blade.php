@extends('template')

@section('conteudo')
    <div class="row justify-content-center"><div class="col-md-6 col-lg-5">
        <h1 class="h3 mb-4">Criar conta</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Criar conta</button>
        </form>
        <a class="d-inline-block mt-3" href="{{ route('login') }}">Já tenho uma conta</a>
    </div></div>
@endsection
