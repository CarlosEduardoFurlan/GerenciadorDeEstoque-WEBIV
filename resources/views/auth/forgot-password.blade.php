@extends('template')

@section('conteudo')
    <div class="row justify-content-center"><div class="col-md-6 col-lg-5">
        <h1 class="h3 mb-3">Recuperar senha</h1>
        <p>Informe seu e-mail para receber um link de redefinição.</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enviar link</button>
        </form>
        <a class="d-inline-block mt-3" href="{{ route('login') }}">Voltar ao login</a>
    </div></div>
@endsection
