<?php


namespace App\Http\Controllers;

use App\Services\FilmService;
use Illuminate\Http\Request;

class FilmsController
{
    private $filmService;

    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
    }

    public function index()
    {
        return $this->filmService->filmsList();
    }

    public function show($id)
    {
        return $this->filmService->filmDetails($id);
    }

    public function store(Request $request)
    {
        return $this->filmService->createFilm($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->filmService->updateFilm($id, $request->all());
    }

    public function delete($id)
    {
        return $this->filmService->supprimerFilm($id);
    }

    public function filmsByYear($annee){
        return $this->filmService->filmsByYear($annee);
    }

    public function actorFilms($id){
        return $this->filmService->filmsByActor($id);
    }
}
