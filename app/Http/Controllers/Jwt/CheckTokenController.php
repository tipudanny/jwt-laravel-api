<?php

namespace App\Http\Controllers\Jwt;
use App\Http\Controllers\Controller;

class CheckTokenController extends Controller
{
    /**
     * Log the user auth Check (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function isTokenValid()
    {
        if(auth()->check()){
            return response()->json([ 'valid' => 'authenticed' ]);
        }
        else return response()->json([ 'valid' =>  'unauthenticed']);
    }
}
