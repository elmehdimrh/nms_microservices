<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function generateToken(Request $request)
    {
        $this->validate($request, [
            'grant_type' => 'required|in:client_credentials',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        $client_id = $request->input('client_id');
        $client_secret = $request->input('client_secret');

        return base64_encode($client_id.':'.$client_secret);
    }
}
