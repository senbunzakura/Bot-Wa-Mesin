<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_laporan',
        'nomor_whatsapp',
        'mesin_id',
        'isi_laporan',
        'status',
    ];

    // Relasi ke Mesin (nullable)
    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    // Relasi ke Perbaikan
    public function perbaikan()
    {
        return $this->hasOne(Perbaikan::class, 'laporan_perbaikan_id');
    }
}
