<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Option;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // show login form
    public function showLoginForm()
    {
        return view('auth.admin-login'); // create this blade
    }
    
   
    

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string'],
            'password' => ['required','string'],
        ]);

        // Attempt to log the admin in using admin guard
        if (Auth::guard('admin')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
