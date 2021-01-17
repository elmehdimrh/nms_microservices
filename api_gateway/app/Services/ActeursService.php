<?php

namespace App\Services;

use App\Models\Microservice;
use Illuminate\Support\Facades\Http;

class ActeursService
{
    private $base_url = null;
    private $nom = 'acteurs';

    public function __construct()
    {
        $this->base_url = Microservice::where('nom', $this->nom)->value('base_url');
    }

    public function acteursList()
    {
        return Http::get($this->base_url . '/actors/all')->json();
    }

    public function acteurDetails($id)
    {
        $response = Http::get($this->base_url . '/actor/read/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }

        return $response->json();

    }

    public function createActeur($data)
    {
        $response = Http::post($this->base_url . '/actor/create', $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function updateActeur($id,$data)
    {
        $response = Http::put($this->base_url . '/actor/update/' . $id, $data);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }

    public function supprimerActeur($id)
    {
        $response = Http::delete($this->base_url . '/actor/delete/' . $id);

        if ($response->failed()) {
            return response()->json($response->json(), $response->status());
        }
        return $response->json();
    }


}
