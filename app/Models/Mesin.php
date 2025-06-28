<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;

     protected $fillable = [
        'kode_mesin',
        'nama_mesin',
        'lokasi',
        'status',
    ];

  // Relasi ke Perawatan
    public function perawatans()
    {
        return $this->hasMany(Perawatan::class);
    }

    // Relasi ke Laporan Kerusakan
    public function laporanKerusakans()
    {
        return $this->hasMany(LaporanKerusakan::class);
    }

     // Function generate kode mesin otomatis
    public static function generateKodeMesin()
    {
        $lastMesin = self::orderBy('id', 'desc')->first();

        if (!$lastMesin) {
            $number = 1;
        } else {
            // Ambil angka dari kode terakhir, misal "MSN-0005" -> 5
            $lastNumber = (int) substr($lastMesin->kode_mesin, 4);
            $number = $lastNumber + 1;
        }

        return 'MSN-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
