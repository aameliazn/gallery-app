<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerAction(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ])->Validate();

        User::create([
            'name' => $request->name,
            'address' => $request->address,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Berhasil mendaftar');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Berhasil masuk');
    }

    public function logoutAction(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/')->with('success', 'Berhasil keluar');
    }
}
