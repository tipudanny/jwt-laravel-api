<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

trait UserInfo
{
    /**
     * Get All User Information.
     *
     * @param null $type
     * @return JsonResponse
     */
    public function getUsers($type = null): JsonResponse
    {
        if ($type){
            $users = User::where('user_type',$type)->whereNotIn('id', [Auth::id()])->paginate(5);
        }else {
            $users = User::whereNotIn('id', [Auth::id()])->paginate(5);
        }

        return response()->json(['users' =>$users ]);
    }

}
