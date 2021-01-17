<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmsController extends Controller
{
    private $acteurs_uri = null;

    public function __construct()
    {
        $this->acteurs_uri = config('films.ACTORS_API');
    }

    public function index()
    {
        $films = Film::all();
        return response()->json($films, 200);
    }

    public function show($id)
    {
        try {
            $film = Film::findOrFail($id);

            return response()->json(array(
                'id' => $film->id,
                'annee' => $film->annee,
                'acteurs' => $film->acteurs
            ), 200);

        } catch (ModelNotFoundException $exception) {
            return response()->json('Film introuvable', 404);
        }
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nom' => 'required|max:250',
            'annee' => 'required|digits:4',
            'acteurs_ids' => 'required|array',
            'acteurs_ids.*' => 'distinct'
        ]);

        $actors = collect($request->input('acteurs_ids'))->map(function ($item) {
            $response = Http::get($this->acteurs_uri . '/read/' . $item)->json();
            return array('id' => $response["id"], 'nom' => $response["nom"]);
        })->toArray();


        $film = Film::create([
            'nom' => trim($request->input('nom')),
            'annee' => trim($request->input('annee')),
            'acteurs' => serialize($actors),
        ]);

        return response()->json($film->id, 201);

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|max:250',
            'annee' => 'required|digits:4',
            'acteurs_ids' => 'required|array',
            'acteurs_ids.*' => 'distinct'
        ]);

        $actors = collect($request->input('acteurs_ids'))->map(function ($item) {
            $response = Http::get($this->acteurs_uri . '/read/' . $item)->json();
            return array('id' => $response["id"], 'nom' => $response["nom"]);
        })->toArray();

        try {

            $film = Film::findOrFail($id);
            $film->nom = $request->input('nom');
            $film->annee = $request->input('annee');
            $film->acteurs = serialize($actors);
            $film->save();

            return response()->json($film, 200);

        } catch (ModelNotFoundException $exception) {
            return response()->json('Film not found', 404);
        }

    }

    public function delete($id)
    {
        try {
            $film = Film::findOrFail($id);
            $film->delete();
            return response()->json('film deleted with success', 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json('film not found', 404);
        }
    }

    public function moviesByYear($year){

        if(!filter_var($year,FILTER_VALIDATE_INT)){
            return response()->json('YEAR INVALID',400);
        }

        return Film::where('annee',$year)->get();
    }

    public function moviesByActor($id){
        $query = '%"id";i:'.$id.'%';

        return Film::where('acteurs','LIKE',$query)->select('nom','annee')->get();
    }
}
