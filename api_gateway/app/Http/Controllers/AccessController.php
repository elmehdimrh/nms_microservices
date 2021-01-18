<?php


namespace App\Http\Controllers;

use App\Models\Microservice;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function retrieveToken(Request $request)
    {
        $this->validate($request, [
            'grant_type' => 'required|in:client_credentials',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        $client_id = $request->input('client_id');
        $client_secret = $request->input('client_secret');

        $nom = null;

        if ( $client_id === "gateway" && $client_secret === "20nomalis21") {
            $nom = "gateway";
        } else if( $client_id === "actors" && $client_secret === "20nomalis21") {
            $nom = "acteurs";
        }else if($client_id === "movies" && $client_secret === "20nomalis21"){
            $nom = "films";
        }

        if($nom === null){
            return response()->json([
                'error' => 'credentials invalid'
            ],401);
        }

        $token = Microservice::where('nom', $nom)->value('token');

        return $token != null ? response()->json(['access_token' => $token,"token_type" => "Bearer"],200) : response()->json(['error' => 'not found'],401);

    }
}
