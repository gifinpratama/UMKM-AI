<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            ActivityLog::log('login', 'User logged in');
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return $this->redirectByRole();
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $tenantId = 'tenant_' . Str::random(12);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'tenant_id' => $tenantId,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        // Create UMKM database record
        \App\Models\UmkmDatabase::create([
            'user_id' => $user->id,
            'tenant_id' => $tenantId,
            'db_name' => 'DB-' . Str::upper(Str::random(8)),
            'db_description' => 'Database untuk ' . $request->business_name,
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        Auth::login($user);
        ActivityLog::log('register', 'New seller registered: ' . $user->business_name);

        return redirect()->route('seller.dashboard');
    }

    public function logout(Request $request)
    {
        ActivityLog::log('logout', 'User logged out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    protected function redirectByRole()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('seller.dashboard');
    }
}
