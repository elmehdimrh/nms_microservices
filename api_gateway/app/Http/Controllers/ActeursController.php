<?php

namespace App\Http\Controllers;

use App\Services\ActeursService;
use Illuminate\Http\Request;

class ActeursController extends Controller
{
    private $acteurService;

    public function __construct(ActeursService $acteurService)
    {
        $this->acteurService = $acteurService;
    }

    public function index()
    {
        return $this->acteurService->acteursList();
    }

    public function show($id)
    {
        return $this->acteurService->acteurDetails($id);
    }

    public function store(Request $request)
    {
        return $this->acteurService->createActeur($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->acteurService->updateActeur($id,$request->all());
    }

    public function delete($id)
    {
        return $this->acteurService->supprimerActeur($id);
    }

}
