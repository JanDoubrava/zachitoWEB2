<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Zobrazí přihlašovací formulář
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Zpracuje přihlašovací požadavek
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('orders.index'));
        }

        throw ValidationException::withMessages([
            'email' => ['Zadané přihlašovací údaje jsou nesprávné.'],
        ]);
    }

    /**
     * Zobrazí registrační formulář
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Zpracuje registrační požadavek
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('orders.index');
    }

    /**
     * Zpracuje odhlášení
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 