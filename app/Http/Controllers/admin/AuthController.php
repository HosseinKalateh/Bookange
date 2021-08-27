<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('livewire.admin.auth.login');
    }

    public function login(Request $request)
    {
        // Retrive Input & Add is_superuser 
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_superuser' => true
        ];

        if (Auth::attempt($credentials)) {
            // if success login

            return redirect('admin');
        }
        // if failed login
        return redirect('/admin/login');
    }
}
