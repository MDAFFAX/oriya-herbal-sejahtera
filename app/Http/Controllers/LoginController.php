<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('kasir.transaksi-penjualan.create');
            }
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,kasir',
        ]);

        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        // Find or create user
        $user = User::where('email', $email)
                    ->where('role', $role)
                    ->first();

        if (!$user) {
            // Create new user if doesn't exist
            $user = User::create([
                'name' => $role === 'admin' ? 'Admin' : 'Kasir',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
            ]);
        } else {
            // Update password if user exists but password doesn't match
            if (!Hash::check($password, $user->password)) {
                $user->password = Hash::make($password);
                $user->save();
            }
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('kasir.transaksi-penjualan.create');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
