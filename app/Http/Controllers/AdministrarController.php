<?php

namespace App\Http\Controllers;

use App\Models\Productes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministrarController extends Controller
{
    public function index()
    {
        $productes = Productes::paginate(10);
        return view("producte.administrar", compact("productes"));
    }

    public function create()
    {
        $producte = new Productes;
        $title = __("Afegir producte");
        $textButton = __("Afegir");
        $route = route("producte.administrar.store");

        return view("producte.administrar.create", compact(
            "producte",
            "title",
            "textButton",
            "route"
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "preu" => "required",
            "img" => "required|image",
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {

            // guarda archivo en storage/app/public/products
            $path = $request->file('img')->store('products', 'public');

            // guarda SOLO la ruta
            $data['img'] = $path;
        }

        Productes::create($data);

        return redirect()->route("producte.administrar.index")
            ->with("success", __("Producte afegit correctament!"));
    }

    public function edit(Productes $administrar)
    {
        return view("producte.administrar.edit", [
            "producte" => $administrar,
            "update" => true,
            "title" => __("Editar producte"),
            "textButton" => __("Actualitzar"),
            "route" => route("producte.administrar.update", $administrar->id)
        ]);
    }

    public function update(Request $request, Productes $administrar)
    {
        $request->validate([
            "nom" => "required",
            "preu" => "required",
            "img" => "nullable|image",
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {

            // borrar imagen anterior
            if ($administrar->img) {
                Storage::disk('public')->delete($administrar->img);
            }

            $path = $request->file('img')->store('products', 'public');
            $data['img'] = $path;
        }

        $administrar->update($data);

        return back()->with("success", __("Producte actualitzat correctament!"));
    }

    public function destroy(Productes $administrar)
    {
        if ($administrar->img) {
            Storage::disk('public')->delete($administrar->img);
        }

        $administrar->delete();

        return back()->with("success", __("Producte eliminat correctament"));
    }
}