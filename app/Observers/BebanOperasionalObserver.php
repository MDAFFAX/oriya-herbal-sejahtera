<?php

namespace App\Observers;

use App\Models\BebanOperasional;
use App\Models\JurnalUmum;

class BebanOperasionalObserver
{
    /**
     * Handle the BebanOperasional "created" event.
     */
    public function created(BebanOperasional $beban): void
    {
        // Generate unique reference
        $ref = 'BEBAN-' . $beban->id . '-' . date('YmdHis');

        // Create jurnal umum entry
        JurnalUmum::create([
            'tanggal' => $beban->tanggal_pengeluaran,
            'nama_akun' => $beban->nama_akun,
            'ref' => $ref,
            'debet' => $beban->nominal,
            'kredit' => 0,
        ]);
    }

    /**
     * Handle the BebanOperasional "updated" event.
     */
    public function updated(BebanOperasional $beban): void
    {
        // Delete old jurnal entries for this beban
        JurnalUmum::where('ref', 'like', 'BEBAN-' . $beban->id . '-%')->delete();

        // Generate unique reference
        $ref = 'BEBAN-' . $beban->id . '-' . date('YmdHis');

        // Create new jurnal umum entry
        JurnalUmum::create([
            'tanggal' => $beban->tanggal_pengeluaran,
            'nama_akun' => $beban->nama_akun,
            'ref' => $ref,
            'debet' => $beban->nominal,
            'kredit' => 0,
        ]);
    }

    /**
     * Handle the BebanOperasional "deleted" event.
     */
    public function deleted(BebanOperasional $beban): void
    {
        // Delete corresponding jurnal entries
        JurnalUmum::where('ref', 'like', 'BEBAN-' . $beban->id . '-%')->delete();
    }
}
