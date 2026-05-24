<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\COA;
use Illuminate\Support\Facades\Auth;

class COAController extends Controller
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

        $coas = COA::orderBy('kode_akun')->get();
        
        return view('admin.coa.index', [
            'coas' => $coas,
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

        return view('admin.coa.create', [
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
            'kode_akun' => 'required|string|unique:coas,kode_akun|max:255',
            'nama_akun' => 'required|string|max:255',
            'header_akun' => 'required|string|max:255',
        ]);

        COA::create([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'header_akun' => $request->header_akun,
        ]);

        return redirect()->route('coa.index')->with('success', 'Akun COA berhasil ditambahkan.');
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

        $coa = COA::findOrFail($id);

        return view('admin.coa.edit', [
            'coa' => $coa,
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

        $coa = COA::findOrFail($id);

        $request->validate([
            'kode_akun' => 'required|string|max:255|unique:coas,kode_akun,' . $id,
            'nama_akun' => 'required|string|max:255',
            'header_akun' => 'required|string|max:255',
        ]);

        $coa->update([
            'kode_akun' => $request->kode_akun,
            'nama_akun' => $request->nama_akun,
            'header_akun' => $request->header_akun,
        ]);

        return redirect()->route('coa.index')->with('success', 'Akun COA berhasil diperbarui.');
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

        $coa = COA::findOrFail($id);
        $coa->delete();

        return redirect()->route('coa.index')->with('success', 'Akun COA berhasil dihapus.');
    }
}
