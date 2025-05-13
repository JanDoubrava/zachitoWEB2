@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header" style="background-color: var(--primary-color);">
                    <h4 class="mb-0 text-white">Přihlášení</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="mb-3">
                            <label for="password" class="form-label">Heslo</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Zapamatovat si mě</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: var(--accent-color); color: var(--white);">
                                Přihlásit se
                            </button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: var(--accent-color);">
                            Zapomněli jste heslo?
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 