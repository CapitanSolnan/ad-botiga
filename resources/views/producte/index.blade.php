@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tienda</h1>
    <div class="row">
        @foreach($productes as $producte)
            <div class="col-md-3 mb-4">
                <div class="card h-100 d-flex flex-column ">
                    <img src="{{ asset('storage/' . $producte->img) }}" class="card-img-top" alt="{{ $producte->nom }}" style="height: 300px; object-fit: cover;">
                    <!-- Contenido abajo -->
                    <div class="card-body d-flex flex-column mt-auto text-center">
                        <h5 class="card-title">{{ $producte->nom }}</h5>
                        <p class="card-text">{{ number_format($producte->preu, 2) }} €</p>
                        <a href="{{ route('producte.show', $producte->id) }}" class="btn btn-primary mt-auto">Inspeccionar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $productes->links() }}
</div>
@endsection