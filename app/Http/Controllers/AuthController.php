<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function LoginView(Request $request)
    {
        return view('login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.products.index'));
            } elseif (Auth::user()->role === 'user') {
                return redirect()->intended(route('user.home'));
            }
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput();
    }

    public function Logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function RegisterView() {
        return view('register');

    }

    public function Register(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:3|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|in:user,admin', // biarkan default user
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default selalu user
        ]);

        // Auto login after registration
        Auth::login($user);

        return redirect()->route('user.home')->with('success', 'Registration successful! Welcome to BonoJiten.');
    }
}
