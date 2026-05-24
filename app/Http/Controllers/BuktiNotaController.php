<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiPenjualan;

class BuktiNotaController extends Controller
{
    // Kasir methods
    public function index()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'kasir') {
            return redirect()->route('login');
        }

        $transaksis = TransaksiPenjualan::with(['detailTransaksis.produk'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('kasir.bukti-nota.index', [
            'user' => $user,
            'transaksis' => $transaksis,
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $transaksi = TransaksiPenjualan::with(['detailTransaksis.produk', 'user'])
            ->findOrFail($id);

        // Check authorization: kasir can only see their own, admin can see all
        if ($user->role === 'kasir' && $transaksi->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('bukti-nota.show', [
            'user' => $user,
            'transaksi' => $transaksi,
        ]);
    }

    public function print($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $transaksi = TransaksiPenjualan::with(['detailTransaksis.produk', 'user'])
            ->findOrFail($id);

        // Check authorization: kasir can only see their own, admin can see all
        if ($user->role === 'kasir' && $transaksi->user_id !== $user->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('bukti-nota.print', [
            'transaksi' => $transaksi,
        ]);
    }

    // Admin methods
    public function adminIndex()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $transaksis = TransaksiPenjualan::with(['detailTransaksis.produk', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.bukti-nota.index', [
            'user' => $user,
            'transaksis' => $transaksis,
        ]);
    }
}
