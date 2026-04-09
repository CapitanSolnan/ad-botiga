<?php

namespace App\Http\Controllers;

use App\Models\Productes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

        return view("producte.administrar.create", compact("producte", "title", "textButton", "route"));
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
            $file = $request->file('img');

            // generar hash
            $hash = hash_file('sha256', $file->getRealPath());

            // comprobar duplicados
            if (Productes::where('hash', $hash)->exists()) {
                return back()->withErrors(['img' => 'Aquesta imatge ja existeix']);
            }

            // guardar imagen
            $data['img'] = $file->store('products', 'public');

            // guardar hash
            $data['hash'] = $hash;
        }

        Productes::create($data);

        return redirect(route("producte.administrar.index"))
            ->with("success", __("Producte afegit correctament!"));
    }

    public function edit(Productes $administrar)
    {
        $update = true;
        $title = __("Editar producte");
        $textButton = __("Actualitzar");
        $route = route("producte.administrar.update", ["administrar" => $administrar->id]);

        return view("producte.administrar.edit", [
            "producte" => $administrar,
            "update" => $update,
            "title" => $title,
            "textButton" => $textButton,
            "route" => $route
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
            $file = $request->file('img');

            // generar hash
            $hash = hash_file('sha256', $file->getRealPath());

            // comprobar duplicados (excepto el actual)
            if (Productes::where('hash', $hash)
                ->where('id', '!=', $administrar->id)
                ->exists()) {
                return back()->withErrors(['img' => 'Aquesta imatge ja existeix']);
            }

            // borrar imagen antigua
            if ($administrar->img) {
                Storage::disk('public')->delete($administrar->img);
            }

            // guardar nueva imagen
            $data['img'] = $file->store('products', 'public');
            $data['hash'] = $hash;
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