<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get All User Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUser()
    {
        return response()->json(User::all()->except(Auth::id()));
    }
    /**
     * Get All managers Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function managers()
    {
        $managers = User::where('user_type','manager')->get();
        return response()->json($managers);
    }
    /**
     * Get All riders Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function riders()
    {
        $riders = User::where('user_type','rider')->get();
        return response()->json($riders);
    }
    /**
     * Get All customers Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function customers()
    {
        $customers = User::where('user_type','customer')->get();
        return response()->json($customers);
    }

}
