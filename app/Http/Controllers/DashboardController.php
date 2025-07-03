<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\perawatan;
use App\Models\Perbaikan;
use App\Models\LaporanKerusakan;
use App\Models\Mesin;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMesin = Mesin::count();
        $totalPerawatan = perawatan::count();
        $totalPerbaikan = Perbaikan::count();
        $totalLaporan = LaporanKerusakan::count();

        $statusLaporanList = ['Diterima', 'Diproses', 'Selesai', 'Tertunda'];
        $statusPerbaikanList = ['Dijadwalkan', 'Dalam Proses', 'Tertunda', 'Selesai'];
        $statusPerawatanList = ['Dalam Pengerjaan', 'Selesai', 'Tertunda'];

        // Pie chart data
        $statusLaporanRaw = LaporanKerusakan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();
        $statusPerbaikanRaw = Perbaikan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();
        $statusPerawatanRaw = perawatan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')->pluck('total', 'status')->toArray();

        $statusLaporan = collect($statusLaporanList)->mapWithKeys(fn($s) => [$s => $statusLaporanRaw[$s] ?? 0]);
        $statusPerbaikan = collect($statusPerbaikanList)->mapWithKeys(fn($s) => [$s => $statusPerbaikanRaw[$s] ?? 0]);
        $statusPerawatan = collect($statusPerawatanList)->mapWithKeys(fn($s) => [$s => $statusPerawatanRaw[$s] ?? 0]);

        // Bar chart data per bulan per status (stacked)
        $bulanLabels = range(1, 12);

        // Laporan
        $laporanByBulan = [];
        foreach (['pending' => 'Diterima', 'proses' => 'Diproses', 'selesai' => 'Selesai'] as $key => $status) {
            $laporanByBulan[$key] = [];
            foreach ($bulanLabels as $bulan) {
                $laporanByBulan[$key][] = LaporanKerusakan::where('status', $status)
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', date('Y'))
                    ->count();
            }
        }

        // Perbaikan
        $perbaikanByBulan = [];
        foreach (['proses' => 'Dalam Proses', 'tertunda' => 'Tertunda', 'selesai' => 'Selesai'] as $key => $status) {
            $perbaikanByBulan[$key] = [];
            foreach ($bulanLabels as $bulan) {
                $perbaikanByBulan[$key][] = Perbaikan::where('status', $status)
                    ->whereMonth('tanggal_pekerjaan', $bulan)
                    ->whereYear('tanggal_pekerjaan', date('Y'))
                    ->count();
            }
        }

        // Perawatan
        $perawatanByBulan = [];
        foreach (['proses' => 'Dalam Pengerjaan', 'tertunda' => 'Tertunda', 'selesai' => 'Selesai'] as $key => $status) {
            $perawatanByBulan[$key] = [];
            foreach ($bulanLabels as $bulan) {
                $perawatanByBulan[$key][] = Perawatan::where('status', $status)
                    ->whereMonth('tanggal_pekerjaan', $bulan)
                    ->whereYear('tanggal_pekerjaan', date('Y'))
                    ->count();
            }
        }

        return view('dashboard', compact(
            'totalMesin',
            'totalPerawatan',
            'totalPerbaikan',
            'totalLaporan',
            'statusLaporan',
            'statusPerbaikan',
            'statusPerawatan',
            'laporanByBulan',
            'perbaikanByBulan',
            'perawatanByBulan'
        ));
    }
}
