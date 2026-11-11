<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show register form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'class' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'class' => $validated['class'],
            'role' => 'user', // Default role is user
        ]);

        // Flush old input from session to prevent form data leakage
        request()->session()->forget('_old_input');
        
        // Redirect to login page without auto-login
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan akun yang telah dibuat.');
    }
}
