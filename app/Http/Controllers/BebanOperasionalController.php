<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BebanOperasional;
use App\Models\COA;
use Illuminate\Support\Facades\Auth;

class BebanOperasionalController extends Controller
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

        $bebans = BebanOperasional::orderBy('tanggal_pengeluaran', 'desc')->get();
        
        return view('admin.beban-operasional.index', [
            'bebans' => $bebans,
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

        // Get akun dari COA (hanya akun yang kode_akun mulai dari 5xx untuk beban)
        $coas = COA::all();
        
        return view('admin.beban-operasional.create', [
            'user' => $user,
            'coas' => $coas
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

        // Validate
        $request->validate([
            'kode_akun' => 'required|string',
            'nominal' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
        ]);

        // Get COA data
        $coa = COA::where('kode_akun', $request->kode_akun)->first();

        if (!$coa) {
            return redirect()->back()->with('error', 'Akun COA tidak ditemukan')->withInput();
        }

        // Create beban operasional
        BebanOperasional::create([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $coa->nama_akun,
            'nominal' => $request->nominal,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ]);

        return redirect()->route('beban-operasional.index')->with('success', 'Beban operasional berhasil ditambahkan.');
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

        $beban = BebanOperasional::findOrFail($id);
        $coas = COA::all();

        return view('admin.beban-operasional.edit', [
            'beban' => $beban,
            'user' => $user,
            'coas' => $coas
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

        $beban = BebanOperasional::findOrFail($id);

        $request->validate([
            'kode_akun' => 'required|string',
            'nominal' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
        ]);

        // Get COA data
        $coa = COA::where('kode_akun', $request->kode_akun)->first();

        if (!$coa) {
            return redirect()->back()->with('error', 'Akun COA tidak ditemukan')->withInput();
        }

        $beban->update([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $coa->nama_akun,
            'nominal' => $request->nominal,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
        ]);

        return redirect()->route('beban-operasional.index')->with('success', 'Beban operasional berhasil diperbarui.');
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

        $beban = BebanOperasional::findOrFail($id);
        $beban->delete();

        return redirect()->route('beban-operasional.index')->with('success', 'Beban operasional berhasil dihapus.');
    }
}
