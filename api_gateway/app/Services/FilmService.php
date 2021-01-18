<?php


namespace App\Services;


use App\Models\Microservice;
use Illuminate\Support\Facades\Http;

class FilmService
{
    private $base_url = null;
    private $nom = 'films';
    private $token = null;

    public function __construct()
    {
        $ms = Microservice::where('nom', $this->nom)->first();

        $this->base_url = $ms->base_url;
        $this->token = $ms->token;
    }

    public function filmsList()
    {
        return Http::withToken($this->token)->get($this->base_url . '/movies/all')->json();
    }

    public function filmDetails($id)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/movie/read/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function createFilm($data)
    {
        $response = Http::withToken($this->token)->post($this->base_url . '/movie/create', $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function updateFilm($id, $data)
    {
        $response = Http::withToken($this->token)->put($this->base_url . '/movie/update/' . $id, $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function supprimerFilm($id)
    {
        $response = Http::withToken($this->token)->delete($this->base_url . '/movie/delete/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function filmsByYear($year)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/movies/' . $year);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function filmsByActor($id)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/movies/actor/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }
}
