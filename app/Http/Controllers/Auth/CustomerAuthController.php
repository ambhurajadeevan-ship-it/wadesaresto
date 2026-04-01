<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Ambil intended URL dari session secara manual,
            // tapi TOLAK jika mengarah ke /admin/* untuk keamanan
            $intended = session()->pull('url.intended');

            if ($intended && !str_contains($intended, '/admin')) {
                return redirect($intended);
            }

            // Default selalu ke /booking
            return redirect('/booking');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'no_hp'    => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Setelah register langsung ke /booking
        return redirect('/booking');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}