<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        if ($user->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        // Get today's date
        $today = now()->format('Y-m-d');

        // Penjualan hari ini (jumlah transaksi)
        $penjualanHariIni = TransaksiPenjualan::whereDate('tanggal', $today)->count();

        // Pendapatan hari ini (total bayar)
        $pendapatanHariIni = TransaksiPenjualan::whereDate('tanggal', $today)
            ->sum('total_bayar');

        // Pelanggan baru hari ini (pelanggan yang pertama kali transaksi hari ini)
        // Ambil semua pelanggan yang transaksi hari ini
        $pelangganHariIni = TransaksiPenjualan::whereDate('tanggal', $today)
            ->whereNotNull('nama_pelanggan')
            ->select('nama_pelanggan', 'no_hp')
            ->distinct()
            ->get();

        // Hitung pelanggan yang transaksi hari ini adalah transaksi pertama mereka
        $pelangganBaruHariIni = 0;
        foreach ($pelangganHariIni as $pelanggan) {
            // Cek apakah ada transaksi sebelumnya untuk pelanggan ini
            $transaksiSebelumnya = TransaksiPenjualan::where('nama_pelanggan', $pelanggan->nama_pelanggan)
                ->where(function($query) use ($pelanggan) {
                    if ($pelanggan->no_hp) {
                        $query->where('no_hp', $pelanggan->no_hp);
                    } else {
                        $query->whereNull('no_hp');
                    }
                })
                ->whereDate('tanggal', '<', $today)
                ->exists();

            // Jika tidak ada transaksi sebelumnya, berarti pelanggan baru
            if (!$transaksiSebelumnya) {
                $pelangganBaruHariIni++;
            }
        }

        return view('admin.dashboard', [
            'user' => $user,
            'penjualanHariIni' => $penjualanHariIni,
            'pendapatanHariIni' => $pendapatanHariIni,
            'pelangganBaruHariIni' => $pelangganBaruHariIni,
        ]);
    }
}
