<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.index', compact('carrito'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $nombre = $request->nombre;
        $precio = $request->precio;

        $carrito = session()->get('carrito', []);

        $carrito[$id] = [
            'id' => $id,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $carrito[$id]['cantidad'] ?? 1, 
        ];

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }

    public function update(Request $request, $id)
    {
        $cantidad = max(1, (int) $request->input('cantidad'));
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect('/carrito');
    }

    public function comprar()
    {
        return view('carrito.comprar', compact('carrito'));
    }

    public function show()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito.comprar', compact('carrito'));
    }

}