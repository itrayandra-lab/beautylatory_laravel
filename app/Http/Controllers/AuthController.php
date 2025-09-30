<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->verifyPassword($request->password)) {
            // Store admin info in session
            session(['admin_id' => $admin->id, 'username' => $admin->username]);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()
            ->withInput($request->only('username'))
            ->withErrors(['credentials' => 'Invalid credentials']);
    }

    /**
     * Handle a logout request.
     */
    public function logout(): RedirectResponse
    {
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}