<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function loginPage()
    {
        return view('usuario.login');
    }

    public function registerPage()
    {
        return view('usuario.register');
    }

    public function register(Request $request)
    {

        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);

        $usuario->save();

        return redirect(route('login'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $request->session()->put('admin', $request->name);

            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed')
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
