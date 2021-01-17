<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ActeursController extends Controller
{

    public function index()
    {
        $acteurs = Acteur::all();
        return response()->json($acteurs, 200);
    }

    public function show($id)
    {
        try {
            $acteur = Acteur::findOrFail($id);
            return response()->json($acteur, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json('Acteur introuvable', 404);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nom' => 'required|max:250'
        ]);

        $nom = $request->input('nom');

        $acteur = Acteur::create([
            'nom' => $nom
        ]);

        return response()->json($acteur->id, 201);

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:250'
        ]);

        try {
            $acteur = Acteur::findOrFail($id);
            $acteur->nom = $request->input('nom');
            $acteur->save();
            return response()->json($acteur, 200);

        } catch (ModelNotFoundException $exception) {
            return response()->json('Acteur not found', 404);
        }
    }

    public function delete($id)
    {
        try {
            $acteur = Acteur::findOrFail($id);
            $acteur->delete();
            return response()->json('actor deleted with success', 200);

        } catch (ModelNotFoundException $exception) {
            return response()->json('actor not found', 404);
        }
    }

}
