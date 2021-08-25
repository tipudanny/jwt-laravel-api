<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\UserInfo;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    use UserInfo;
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get All User Information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUser(Request $request)
    {
        return $this->getUsers($request->type);
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
