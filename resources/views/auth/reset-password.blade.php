@extends('template')

@section('conteudo')
    <div class="row justify-content-center"><div class="col-md-6 col-lg-5">
        <h1 class="h3 mb-4">Definir nova senha</h1>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar nova senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar senha</button>
        </form>
    </div></div>
@endsection
