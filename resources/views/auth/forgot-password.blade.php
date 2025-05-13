@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header" style="background-color: var(--primary-color);">
                    <h4 class="mb-0 text-white">Obnovení hesla</h4>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-muted mb-4">
                        Zapomněli jste heslo? Žádný problém. Stačí zadat vaši e-mailovou adresu a my vám pošleme odkaz pro obnovení hesla.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--white);">
                                Poslat odkaz pro obnovení hesla
                            </button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none" style="color: var(--accent-color);">
                            Zpět na přihlášení
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 