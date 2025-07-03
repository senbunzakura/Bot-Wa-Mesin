<?php

namespace App\Http\Controllers;

use App\Models\perawatan;
use App\Models\Perbaikan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexPerbaikan()
    {
        return view("laporan.perbaikan.index");
    }

    public function printPerbaikan($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_mulai = Carbon::parse($tanggal_awal)->startOfDay()->format('Y-m-d H:i:s');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->endOfDay()->format('Y-m-d H:i:s');

        $perbaikan = Perbaikan::with(['laporanKerusakan'])
            ->whereBetween('tanggal_pekerjaan', [$tanggal_mulai, $tanggal_terakhir])
            ->get();

        $total = $perbaikan->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('laporan.perbaikan.cetak', compact('perbaikan', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

    public function indexPerawatan()
    {
        return view("laporan.perawatan.index");
    }

    public function printPerawatan($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_mulai = Carbon::parse($tanggal_awal)->startOfDay()->format('Y-m-d H:i:s');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->endOfDay()->format('Y-m-d H:i:s');

        $perawatans = perawatan::with(['mesin', 'mekanik'])
            ->whereBetween('tanggal_pekerjaan', [$tanggal_mulai, $tanggal_terakhir])
            ->get();

        $total = $perawatans->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('laporan.perawatan.cetak', compact('perawatans', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

}
