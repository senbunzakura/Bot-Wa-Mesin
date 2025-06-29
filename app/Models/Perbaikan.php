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
        'mekanik_id',
        'catatan_selesai',
        'tanggal_selesai',
        'status',
        'foto'
    ];

   // Relasi ke Laporan Kerusakan
    public function laporanKerusakan()
    {
        return $this->belongsTo(LaporanKerusakan::class, 'laporan_perbaikan_id');
    }

    // Relasi ke User (mekanik)
    public function mekanik()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }
}
