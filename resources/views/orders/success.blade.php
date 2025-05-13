@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>

                    <h1 class="display-4 fw-bold mb-4">Děkujeme za Vaši objednávku!</h1>
                    <p class="lead text-muted mb-5">
                        Vaše objednávka byla úspěšně přijata. Budeme Vás kontaktovat co nejdříve.
                    </p>

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-house-door me-2"></i>
                            Zpět na úvod
                        </a>
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>
                            Vytvořit další objednávku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 