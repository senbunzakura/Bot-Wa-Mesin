<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_perbaikan_id',
        'keterangan',
        'prioritas',
        'lokasi',
        'tanggal_pekerjaan',
        'teknisi_id',
        'catatan_selesai',
        'tanggal_selesai',
    ];

   // Relasi ke Laporan Kerusakan
    public function laporanKerusakan()
    {
        return $this->belongsTo(LaporanKerusakan::class, 'laporan_perbaikan_id');
    }

    // Relasi ke User (Teknisi)
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
