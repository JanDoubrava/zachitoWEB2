@extends('layouts.app')

@section('title', 'Kontakt')
@section('description', 'Kontaktujte Čalounictví ZACHITO pro profesionální čalounické služby.')

@section('header')
    <div class="bg-primary py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 text-white mb-3">Kontaktujte nás</h1>
                <p class="lead text-white">Jsme tu pro vás - neváhejte nás kontaktovat</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        {{-- Kontaktní informace --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h3 mb-4">Kde nás najdete</h2>
                    
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt text-primary me-3 mt-1"></i>
                            <div>
                                <h3 class="h5 mb-1">Adresa</h3>
                                <p class="mb-0">
                                    Čalounictví ZACHITO<br>
                                    Vaše Ulice 123<br>
                                    123 45 Město
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="bi bi-telephone text-primary me-3 mt-1"></i>
                            <div>
                                <h3 class="h5 mb-1">Telefon</h3>
                                <p class="mb-0">
                                    <a href="tel:+420123456789" class="text-decoration-none">+420 123 456 789</a>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="bi bi-envelope text-primary me-3 mt-1"></i>
                            <div>
                                <h3 class="h5 mb-1">Email</h3>
                                <p class="mb-0">
                                    <a href="mailto:info@zachito.cz" class="text-decoration-none">info@zachito.cz</a>
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="bi bi-clock text-primary me-3 mt-1"></i>
                            <div>
                                <h3 class="h5 mb-1">Otevírací doba</h3>
                                <p class="mb-0">
                                    Po-Pá: 8:00 - 17:00<br>
                                    So: 9:00 - 12:00<br>
                                    Ne: Zavřeno
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kontaktní formulář --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h3 mb-4">Napište nám</h2>
                    
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="service_id" class="col-md-4 col-form-label text-md-right">Služba</label>
                            <div class="col-md-6">
                                <select id="service_id" class="form-control @error('service_id') is-invalid @enderror" name="service_id" required>
                                    <option value="">Vyberte službu</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} - {{ number_format($service->price, 0, ',', ' ') }} Kč
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Jméno</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Telefon</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Adresa</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="message" class="col-md-4 col-form-label text-md-right">Zpráva</label>
                            <div class="col-md-6">
                                <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Odeslat objednávku
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Formátování telefonního čísla
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9+]/g, '');
        if (value.length > 13) {
            value = value.substr(0, 13);
        }
        e.target.value = value;
    });
</script>
@endpush
@endsection 