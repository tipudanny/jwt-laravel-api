<?php

namespace App\Http\Controllers\Jwt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','isTokenValid','registration']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get a Registration a New User via JWT.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(Registration $request)
    {
        if(auth()->check() && Auth::user()->user_type == 'super-admin'){
            $request->user_type = $request->user_type;
        }
        else $request->user_type = 'customer';

        $user = new User([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'dob'           => $request->dob,
            'address'       => $request->address,
            'user_type'     => $request->user_type,
            'user_branch'   => $request->user_branch,
            'delivary_rate' => $request->delivary_rate,
            'password'      => Hash::make($request->password),
        ]);
        $inserted = $user->save();
        if ($inserted){
            return response()->json(['message'=> 'New User Create Successfully.']);
        }
        else return response()->json(['message'=> 'User creation Failed !!']);
    }


    /**
     * Get a Check JWT token isValid or not.
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


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out','code' => 'logout']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
