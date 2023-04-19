<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $userData = $request->only('name','email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        if(!$user = $user->create($userData)) 
            abort(500,'Invalid Register');

          
            return response()
                        ->json([
                            'data' =>[
                                'user' => $user
                            ]
                        ],200);
    }
}
