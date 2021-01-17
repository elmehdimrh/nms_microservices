<?php


namespace App\Services;


use App\Models\Microservice;
use Illuminate\Support\Facades\Http;

class FilmService
{
    private $base_url = null;
    private $nom = 'films';

    public function __construct()
    {
        $this->base_url = Microservice::where('nom', $this->nom)->value('base_url');
    }

    public function filmsList()
    {
        return Http::get($this->base_url . '/movies/all')->json();
    }

    public function filmDetails($id)
    {
        $response = Http::get($this->base_url . '/movie/read/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function createFilm($data)
    {
        $response = Http::post($this->base_url . '/movie/create', $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function updateFilm($id, $data)
    {
        $response = Http::put($this->base_url . '/movie/update/' . $id, $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function supprimerFilm($id)
    {
        $response = Http::delete($this->base_url . '/movie/delete/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function filmsByYear($year)
    {
        $response = Http::get($this->base_url . '/movies/' . $year);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function filmsByActor($id)
    {
        $response = Http::get($this->base_url . '/movies/actor/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }
}
