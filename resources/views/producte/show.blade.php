@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $producte->img) }}" 
                     class="img-fluid" 
                     alt="{{ $producte->nom }}"
                     style="width: 35vmax; height: 35vmax; object-fit: fill; border: gray 3px solid; border-radius: 10px">
            </div>

            <div class="col-md-6">
                <h2>{{ $producte->nom }}</h2>
                <p class="h4">{{ number_format($producte->preu, 2) }} €</p>

                <form method="POST" action="/carrito">
                    @csrf

                    <input type="hidden" name="id" value="{{ $producte->id }}">
                    <input type="hidden" name="nombre" value="{{ $producte->nom }}">
                    <input type="hidden" name="precio" value="{{ $producte->preu }}">

                    <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                </form>

            </div>
        </div>
    </div>
@endsection