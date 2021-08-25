<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

trait UserInfo
{
    public function getUsers($type = null)
    {
        if ($type){
            $users = User::where('user_type',$type)->get()->except(Auth::id());
        }else $users = User::all()->except(Auth::id());

        return response()->json(['users' =>$users ]);
    }

}
