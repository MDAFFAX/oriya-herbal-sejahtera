<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JurnalUmum;

class BukuBesarController extends Controller
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
        $namaAkun = $request->get('nama_akun', ''); // Default empty

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

        // Get unique account names from jurnal umum
        $akunList = JurnalUmum::select('nama_akun')
            ->distinct()
            ->orderBy('nama_akun', 'asc')
            ->pluck('nama_akun');

        // Initialize buku besar data
        $bukuBesarData = [];
        $saldoAwal = 0;
        $allAccountsData = []; // For "Semua Akun" mode

        // If account is selected, fetch and calculate buku besar
        if ($namaAkun) {
            $startDate = sprintf('%04d-%02d-01', $tahun, $bulan);
            
            // Check if "Semua Akun" is selected
            if ($namaAkun === 'SEMUA') {
                // Get all accounts and process each
                foreach ($akunList as $akun) {
                    // Calculate saldo awal for this account
                    $saldoAwalAkun = JurnalUmum::where('nama_akun', $akun)
                        ->where('tanggal', '<', $startDate)
                        ->selectRaw('COALESCE(SUM(debet), 0) - COALESCE(SUM(kredit), 0) as saldo')
                        ->value('saldo') ?? 0;

                    // Fetch jurnal data for this account
                    $jurnals = JurnalUmum::where('nama_akun', $akun)
                        ->whereYear('tanggal', $tahun)
                        ->whereMonth('tanggal', $bulan)
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('id', 'asc')
                        ->get();

                    // Build buku besar data with running balance for this account
                    $saldoBerjalan = $saldoAwalAkun;
                    $accountData = [
                        'nama_akun' => $akun,
                        'saldo_awal' => $saldoAwalAkun,
                        'transaksis' => []
                    ];
                    
                    foreach ($jurnals as $jurnal) {
                        $saldoBerjalan = $saldoBerjalan + $jurnal->debet - $jurnal->kredit;
                        
                        $accountData['transaksis'][] = [
                            'tanggal' => $jurnal->tanggal,
                            'nama_akun' => $jurnal->nama_akun,
                            'ref' => $jurnal->ref,
                            'debet' => $jurnal->debet,
                            'kredit' => $jurnal->kredit,
                            'saldo_debet' => $saldoBerjalan >= 0 ? $saldoBerjalan : 0,
                            'saldo_kredit' => $saldoBerjalan < 0 ? abs($saldoBerjalan) : 0,
                        ];
                    }
                    
                    // Only add account if it has transactions or saldo awal
                    if (count($accountData['transaksis']) > 0 || $saldoAwalAkun != 0) {
                        $allAccountsData[] = $accountData;
                    }
                }
            } else {
                // Single account mode
                $saldoAwal = JurnalUmum::where('nama_akun', $namaAkun)
                    ->where('tanggal', '<', $startDate)
                    ->selectRaw('COALESCE(SUM(debet), 0) - COALESCE(SUM(kredit), 0) as saldo')
                    ->value('saldo') ?? 0;

                // Fetch jurnal data for the selected period and account
                $jurnals = JurnalUmum::where('nama_akun', $namaAkun)
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->orderBy('tanggal', 'asc')
                    ->orderBy('id', 'asc')
                    ->get();

                // Build buku besar data with running balance
                $saldoBerjalan = $saldoAwal;
                
                foreach ($jurnals as $jurnal) {
                    $saldoBerjalan = $saldoBerjalan + $jurnal->debet - $jurnal->kredit;
                    
                    $bukuBesarData[] = [
                        'tanggal' => $jurnal->tanggal,
                        'nama_akun' => $jurnal->nama_akun,
                        'ref' => $jurnal->ref,
                        'debet' => $jurnal->debet,
                        'kredit' => $jurnal->kredit,
                        'saldo_debet' => $saldoBerjalan >= 0 ? $saldoBerjalan : 0,
                        'saldo_kredit' => $saldoBerjalan < 0 ? abs($saldoBerjalan) : 0,
                    ];
                }
            }
        }

        return view('admin.buku-besar.index', [
            'user' => $user,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nama_akun' => $namaAkun,
            'months' => $months,
            'years' => $years,
            'akunList' => $akunList,
            'bukuBesarData' => $bukuBesarData,
            'saldoAwal' => $saldoAwal,
            'allAccountsData' => $allAccountsData,
        ]);
    }
}
