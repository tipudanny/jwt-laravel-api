<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChange;
use App\Http\Requests\ProfileUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Update a Prfile by Admin and User himself.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileUpdate $request){
        if(auth()->check() && Auth::user()->user_type == 'super-admin'){
            if ($request->id){
                $user_id = $request->id;
            }
        }else $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $data =  $request->except('id','email','password');
        //return $user;
        $user->update($data);
        return response()->json(['message'=> 'Profile Update Successfully.']);
    }

    /**
     * Change  password by Admin and User himself.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function passwordUpdate(PasswordChange $request){
        if(auth()->check() && Auth::user()->user_type == 'super-admin'){
            if ($request->user_id){
                $user_id = $request->user_id;
            }
        }else $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $data['password'] = Hash::make($request->password);
        $user->update($data);
        return response()->json(['message'=> 'Password Update Successfully.']);

    }


    /**
     * Delete a Prfile by Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        if(auth()->check() && Auth::user()->user_type == 'super-admin'){
            if ($request->id){
                User::findOrFail($request->id)->delete();
                return response()->json(['message'=> 'Profile Delete Successfully.']);
            }else return response()->json(['message'=> 'Are you kidding with me ? - STUPID.']);
        }return response()->json(['message'=> 'Are you kidding with me ? - STUPID.']);
    }
}
