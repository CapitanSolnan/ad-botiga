@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Mi carrito</h1>

        @if(empty($carrito))
            <div class="alert alert-info text-center">
                El carrito está vacío
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carrito as $id => $producte)
                            <tr>
                                <td>{{ $producte['nombre'] ?? 'Producto desconocido' }}</td>
                                <td>{{ $producte['precio'] ?? 0 }}€</td>
                                <td>
                                    <form method="POST" action="{{ route('carrito.update', $id) }}" class="d-flex">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cantidad" value="{{ $producte['cantidad'] ?? 1 }}" min="1"
                                            class="form-control form-control-sm me-2" style="width: 80px;">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                    </form>
                                </td>
                                <td>{{ ($producte['precio'] ?? 0) * ($producte['cantidad'] ?? 1) }}€</td>
                                <td>
                                    <form method="POST" action="{{ route('carrito.destroy', $id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('carrito.comprar') }}" class="btn btn-success">Pagar</a>
            </div>
        @endif
    </div>
@endsection