<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use App\User; 

class UserController extends Controller
{

    public function changePassword(Request $request)
    {
        
        
        $user = Auth::user();
        
        $curPassword = $request->curPassword;
        $newPassword = $request->newPassword;

        if (Hash::check($curPassword, $user->password)) {
            $user_id = $user->id;
            $obj_user = User::find($user_id)->first();
            $obj_user->password = Hash::make($newPassword);
            $obj_user->save();

            return response()->json(["result"=>true]);
        }
        else
        {
            return response()->json(["result"=>false]);
        }
    }

    public function editProfile()
    {
        $user = Auth::user();   
        return view('admin.user.edit', compact('user'));
    }
}
