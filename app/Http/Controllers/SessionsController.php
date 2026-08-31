<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view(Login::class);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['password' => 'The provided credentials do not match our records.'])
                ->onlyInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Login successful!');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Logout successful!');
    }
}
