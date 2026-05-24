<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        if ($user->role !== 'kasir') {
            abort(403, 'Unauthorized access.');
        }

        return view('kasir.dashboard', [
            'user' => $user
        ]);
    }
}
