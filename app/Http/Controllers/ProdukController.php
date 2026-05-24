<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $produks = Produk::orderBy('kode_produk')->get();
        
        return view('admin.produk.index', [
            'produks' => $produks,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        return view('admin.produk.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'kode_produk' => 'required|string|unique:produks,kode_produk|max:255',
            'nama_produk' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
        ]);

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $produk = Produk::findOrFail($id);

        return view('admin.produk.edit', [
            'produk' => $produk,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $produk = Produk::findOrFail($id);

        $request->validate([
            'kode_produk' => 'required|string|max:255|unique:produks,kode_produk,' . $id,
            'nama_produk' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
        ]);

        $produk->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('login');
        }

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
