<?php

namespace App\Http\Controllers;

use App\Models\Productes;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

            $uploadedFile = Cloudinary::upload(
                $request->file('img')->getRealPath(),
                [
                    'folder' => 'products'
                ]
            );

            $data['img'] = $uploadedFile->getSecurePath();
        }

        Productes::create($data);

        return redirect()->route("producte.administrar.index")
            ->with("success", "Producte creat correctament!");
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

            $uploadedFile = Cloudinary::upload(
                $request->file('img')->getRealPath(),
                [
                    'folder' => 'products'
                ]
            );

            $data['img'] = $uploadedFile->getSecurePath();
        }

        $administrar->update($data);

        return back()->with("success", "Producte actualitzat correctament!");
    }

    public function destroy(Productes $administrar)
    {
        $administrar->delete();

        return back()->with("success", "Producte eliminat correctament");
    }
}