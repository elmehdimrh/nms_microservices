<?php

namespace App\Services;

use App\Models\Microservice;
use Illuminate\Support\Facades\Http;

class ActeursService
{
    private $base_url = null;
    private $nom = 'acteurs';
    private $token = null;

    public function __construct()
    {
        $ms = Microservice::where('nom', $this->nom)->first();

        $this->base_url = $ms->base_url;
        $this->token = $ms->token;
    }

    public function acteursList()
    {
        return Http::withToken($this->token)->get($this->base_url . '/actors/all')->json();
    }

    public function acteurDetails($id)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/actor/read/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function createActeur($data)
    {
        $response = Http::withToken($this->token)->post($this->base_url . '/actor/create', $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function updateActeur($id,$data)
    {
        $response = Http::withToken($this->token)->put($this->base_url . '/actor/update/' . $id, $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function supprimerActeur($id)
    {
        $response = Http::withToken($this->token)->delete($this->base_url . '/actor/delete/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }


}
