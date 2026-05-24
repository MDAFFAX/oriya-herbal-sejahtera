<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\BebanOperasional;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanLabaRugiController extends Controller
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

        // Generate months and years arrays
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $years = range(2015, 2035);

        // Calculate Laba Rugi
        $labaRugi = $this->calculateLabaRugi($bulan, $tahun);

        return view('admin.laporan-laba-rugi.index', [
            'labaRugi' => $labaRugi,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'months' => $months,
            'years' => $years,
        ]);
    }

    public function calculateLabaRugi($bulan, $tahun)
    {
        // Calculate Total Sales (Penjualan)
        $totalPenjualan = TransaksiPenjualan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total_bayar');

        // Calculate Cost of Goods Sold (HPP)
        // Get all detail transaksis for the period and sum up the cost
        $hppData = DB::table('detail_transaksis')
            ->join('transaksi_penjualans', 'detail_transaksis.transaksi_penjualan_id', '=', 'transaksi_penjualans.id')
            ->join('produks', 'detail_transaksis.produk_id', '=', 'produks.id')
            ->whereMonth('transaksi_penjualans.tanggal', $bulan)
            ->whereYear('transaksi_penjualans.tanggal', $tahun)
            ->select('detail_transaksis.jumlah', 'produks.harga_beli')
            ->get();

        $totalHPP = 0;
        foreach ($hppData as $item) {
            if ($item->harga_beli !== null) {
                $totalHPP += $item->jumlah * $item->harga_beli;
            }
        }

        // Calculate Gross Profit (Laba Kotor)
        $labaKotor = $totalPenjualan - $totalHPP;

        // Get Operating Expenses (Beban Operasional)
        $bebanOperasional = BebanOperasional::whereMonth('tanggal_pengeluaran', $bulan)
            ->whereYear('tanggal_pengeluaran', $tahun)
            ->get();

        $bebanDetail = [];
        $totalBeban = 0;
        foreach ($bebanOperasional as $beban) {
            $bebanDetail[] = [
                'nama_akun' => $beban->nama_akun,
                'nominal' => $beban->nominal,
            ];
            $totalBeban += $beban->nominal;
        }

        // Calculate Net Profit (Laba Bersih)
        $labaBersih = $labaKotor - $totalBeban;

        return [
            'totalPenjualan' => $totalPenjualan,
            'totalHPP' => $totalHPP,
            'labaKotor' => $labaKotor,
            'bebanOperasional' => $bebanDetail,
            'totalBeban' => $totalBeban,
            'labaBersih' => $labaBersih,
        ];
    }

    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $labaRugi = $this->calculateLabaRugi($bulan, $tahun);

        $pdf = Pdf::loadView('admin.laporan-laba-rugi.pdf', [
            'labaRugi' => $labaRugi,
            'bulan' => $months[$bulan],
            'tahun' => $tahun,
        ]);

        return $pdf->download('Laporan_Laba_Rugi_' . $months[$bulan] . '_' . $tahun . '.pdf');
    }
}
