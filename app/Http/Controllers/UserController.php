<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    public function detail(){
        return view('user.detail');
    }

    public function updateUser(Request $request)
    {   

        $user = User::find($request->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();
        return redirect()->route('users.detail');
    }
}
