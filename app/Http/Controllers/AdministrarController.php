<?php

namespace App\Http\Controllers;

use App\Models\Productes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

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

        // Inicializar Cloudinary con tu URL
        $cloudinary = new Cloudinary(env('CLOUDINARY_URL'));

        // Subir imagen
        $uploaded = $cloudinary->uploadApi()->upload(
            $request->file('img')->getRealPath(),
            [
                "folder" => "products"
            ]
        );

        // Guardar URL segura en BD
        $data['img'] = $uploaded['secure_url'];
    }

    Productes::create($data);

    return redirect()->route("producte.administrar.index")
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
        $uploaded = Cloudinary::upload(
            $request->file('img')->getRealPath(),
            ["folder" => "products"]
        );

        $data['img'] = $uploaded->getSecurePath();
    }

    $administrar->update($data);

    return back()->with("success", __("Producte actualitzat correctament!"));
}

public function destroy(Productes $administrar)
{
    $administrar->delete();

    return back()->with("success", __("Producte eliminat correctament"));
}
}