<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ADMIN
        if ($user->admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        // COLLECTOR
        if ($user->role === 'collector') {
            return redirect()->route('collector.dashboard');
        }

        // CUSTOMER
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials provided.',
    ]);
}

}
