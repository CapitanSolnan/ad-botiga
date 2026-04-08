<?php

namespace App\Http\Controllers;
use App\Models\Productes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductesController extends Controller
{
        public function index()
    {
        $productes = Productes::paginate(12); // paginación estilo tienda
        return view('producte.index', compact('productes'));
    }

    // Mostrar detalle de un producto
    public function show(Productes $producte)
    {
        return view('producte.show', compact('producte'));
    }


}