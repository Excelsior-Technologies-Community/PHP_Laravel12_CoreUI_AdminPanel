<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email'=>'Invalid Credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
