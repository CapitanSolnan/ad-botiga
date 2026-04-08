@extends('layouts.app')

@section("content")

    <div class="container mt-5">
        <div class="text-center">
            <h1>{{ __("Llistat de producte") }}</h1>
            <a href="{{ route("producte.administrar.create") }}" class="btn btn-primary">
                {{ __("Afegir producte") }}
            </a>
        </div>

        <table class="table table-bordered mb-5 mt-5">

            <tbody>
                @forelse($productes as $producte)
                    <tr>
                        <th scope="row">{{ $producte->id }}</th>
                        <td>{{ $producte->nom }}</td>
                        <td>{{ $producte->preu }}</td>
                        <td>
                            @if($producte->img)
                                <img src="{{ asset('storage/' . $producte->img) }}" alt="Imatge" width="100">
                            @else
                                No hi ha imatge
                            @endif
                        </td>
                        <td>
                            <a href="{{ route("producte.administrar.edit", ["administrar" => $producte]) }}"
                                class="btn btn-warning">{{ __("Editar") }}</a>
                            <a href="#" class="btn btn-danger"
                                onclick="event.preventDefault(); document.getElementById('delete-project-{{ $producte->id }}-form').submit();">{{ __("Eliminar") }}</a>
                            <form id="delete-project-{{ $producte->id }}-form"
                                action="{{ route("producte.administrar.destroy", ["administrar" => $producte]) }}" method="POST"
                                class="hidden">
                                @method("DELETE")
                                @csrf
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="text-center" role="alert">
                                <p><strong class="font-bold">{{ __("No hi ha productes") }}</strong></p>
                                <span>{{ __("No hi ha cap dada a mostrar") }}</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $productes->links() !!}
        </div>
    </div>

@endsection