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
        return response()->json([ 'valid' => auth()->check() ]);
    }
}
