<?php

namespace Database\Seeders;

use App\Models\LaporanKerusakan;
use App\Models\Perbaikan;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanKerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Insert laporan kerusakan
       LaporanKerusakan::create([
            'kode_laporan' => 'LRP-' . now()->format('YmdHis'),
            'nomor_whatsapp' => '081234567890',
            'mesin_id' => 1,
            'isi_laporan' => 'Bunyi berisik pada motor mesin.',
            'status' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert perbaikan
       Perbaikan::create([
            'laporan_perbaikan_id' => 1,
            'keterangan' => 'Motor mesin perlu diganti karena aus.',
            'prioritas' => 'High',
            'lokasi' => 'Area Produksi A',
            'tanggal_pekerjaan' => Carbon::today()->addDays(1),
            'mekanik_id' => 3,
            'status' => 'Dijadwalkan',
            'catatan_selesai' => null,
            'tanggal_selesai' => null,
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
