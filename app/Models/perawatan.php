<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_perawatan',
        'mesin_id',
        'prioritas',
        'tanggal_pekerjaan',
        'keterangan',
        'teknisi_id',
        'status',
        'catatan_selesai',
        'selesai_pada',
    ];

  // Relasi ke Mesin
    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    // Relasi ke User (Teknisi)
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }


}
