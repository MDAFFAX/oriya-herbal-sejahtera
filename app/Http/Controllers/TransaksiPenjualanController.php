<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\COA;
use App\Models\JurnalUmum;

class TransaksiPenjualanController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'kasir') {
            return redirect()->route('login');
        }

        $produks = Produk::all();
        
        return view('kasir.transaksi-penjualan.create', [
            'user' => $user,
            'produks' => $produks,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'kasir') {
            return redirect()->route('login');
        }

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'metode_pembayaran' => 'required|in:Tunai,Transfer',
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'required|exists:produks,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Generate nomor transaksi
            $nomorTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad(TransaksiPenjualan::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            // Calculate total
            $totalBayar = 0;
            $produkIds = $request->produk_id;
            $jumlahs = $request->jumlah;

            foreach ($produkIds as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $jumlahs[$index];
                $subtotal = $produk->harga_jual * $jumlah;
                $totalBayar += $subtotal;
            }

            // Create transaksi penjualan
            $transaksi = TransaksiPenjualan::create([
                'nomor_transaksi' => $nomorTransaksi,
                'tanggal' => now(),
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp ?? null,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_bayar' => $totalBayar,
                'user_id' => $user->id,
                'nama_toko' => 'Oriya Herbal Sejahtera',
            ]);

            // Create detail transaksi
            foreach ($produkIds as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $jumlahs[$index];
                $hargaSatuan = $produk->harga_jual;
                $subtotal = $hargaSatuan * $jumlah;

                DetailTransaksi::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'produk_id' => $produkId,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotal,
                ]);
            }

            // Auto-generate jurnal umum
            $this->generateJurnalUmum($transaksi);

            DB::commit();

            return redirect()->route('bukti-nota.show', $transaksi->id)
                ->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateJurnalUmum(TransaksiPenjualan $transaksi)
    {
        // Cari akun dari COA
        $akunKas = COA::where('kode_akun', '101')->first();
        $akunBank = COA::where('kode_akun', '102')->first();
        $akunPenjualan = COA::where('kode_akun', '401')->first();
        $akunHargaPokok = COA::where('kode_akun', '501')->first(); // Harga Pokok Penjualan
        $akunPersediaan = COA::where('kode_akun', '104')->first(); // Persediaan Barang Dagang

        // Jika akun penjualan tidak ada di COA, jurnal kosong
        if (!$akunPenjualan) {
            return;
        }

        // 1. Debit: Kas atau Bank (dari total transaksi)
        if ($transaksi->metode_pembayaran === 'Tunai') {
            if ($akunKas) {
                JurnalUmum::create([
                    'tanggal' => $transaksi->tanggal,
                    'nama_akun' => $akunKas->nama_akun,
                    'ref' => $akunKas->kode_akun,
                    'debet' => $transaksi->total_bayar,
                    'kredit' => 0,
                    'transaksi_penjualan_id' => $transaksi->id,
                ]);
            }
        } else { // Transfer
            if ($akunBank) {
                JurnalUmum::create([
                    'tanggal' => $transaksi->tanggal,
                    'nama_akun' => $akunBank->nama_akun,
                    'ref' => $akunBank->kode_akun,
                    'debet' => $transaksi->total_bayar,
                    'kredit' => 0,
                    'transaksi_penjualan_id' => $transaksi->id,
                ]);
            }
        }

        // 2. Kredit: Penjualan (dari total transaksi)
        JurnalUmum::create([
            'tanggal' => $transaksi->tanggal,
            'nama_akun' => $akunPenjualan->nama_akun,
            'ref' => $akunPenjualan->kode_akun,
            'debet' => 0,
            'kredit' => $transaksi->total_bayar,
            'transaksi_penjualan_id' => $transaksi->id,
        ]);

        // 3. Debit: Harga Pokok Penjualan & Kredit: Persediaan Barang Dagang
        // Jika kedua akun ada, hitung dari harga beli produk
        if ($akunHargaPokok && $akunPersediaan) {
            // Calculate total dari harga beli
            $totalHargaBeli = 0;
            foreach ($transaksi->detailTransaksis as $detail) {
                $totalHargaBeli += $detail->produk->harga_beli * $detail->jumlah;
            }

            // Jika ada harga beli, buat jurnal
            if ($totalHargaBeli > 0) {
                // Debit: Harga Pokok Penjualan
                JurnalUmum::create([
                    'tanggal' => $transaksi->tanggal,
                    'nama_akun' => $akunHargaPokok->nama_akun,
                    'ref' => $akunHargaPokok->kode_akun,
                    'debet' => $totalHargaBeli,
                    'kredit' => 0,
                    'transaksi_penjualan_id' => $transaksi->id,
                ]);

                // Kredit: Persediaan Barang Dagang
                JurnalUmum::create([
                    'tanggal' => $transaksi->tanggal,
                    'nama_akun' => $akunPersediaan->nama_akun,
                    'ref' => $akunPersediaan->kode_akun,
                    'debet' => 0,
                    'kredit' => $totalHargaBeli,
                    'transaksi_penjualan_id' => $transaksi->id,
                ]);
            }
        }
    }

    // Admin methods
    public function index()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $transaksis = TransaksiPenjualan::with(['user', 'detailTransaksis.produk'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.transaksi-penjualan.index', [
            'user' => $user,
            'transaksis' => $transaksis,
        ]);
    }
}
