<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\UserInfo;
use Illuminate\Http\JsonResponse;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllUser(Request $request): JsonResponse
    {
        return $this->getUsers($request->type);
    }
    /**
     * Get All managers Information.
     *
     * @return JsonResponse
     */
    public function managers(): JsonResponse
    {
        $managers = User::where('user_type','manager')->get();
        return response()->json($managers);
    }
    /**
     * Get All riders Information.
     *
     * @return JsonResponse
     */
    public function riders(): JsonResponse
    {
        $riders = User::where('user_type','rider')->get();
        return response()->json($riders);
    }
    /**
     * Get All customers Information.
     *
     * @return JsonResponse
     */
    public function customers(): JsonResponse
    {
        $customers = User::where('user_type','customer')->get();
        return response()->json($customers);
    }

}
