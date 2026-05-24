<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JurnalUmum;

class JurnalUmumController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        // Get filter parameters
        $bulan = $request->get('bulan', date('n')); // Default current month (1-12)
        $tahun = $request->get('tahun', date('Y')); // Default current year

        // Generate months array
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Generate years array (2015-2035)
        $years = range(2015, 2035);

        // Fetch jurnal data from database
        $jurnals = JurnalUmum::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.jurnal-umum.index', [
            'user' => $user,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'months' => $months,
            'years' => $years,
            'jurnals' => $jurnals
        ]);
    }
}
