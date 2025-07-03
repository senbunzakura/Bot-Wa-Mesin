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
        'mekanik_id',
        'status',
        'tanggal_selesai',
        'foto'
    ];

  // Relasi ke Mesin
    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    // Relasi ke User (mekanik)
    public function mekanik()
    {
        return $this->belongsTo(User::class, 'mekanik_id');
    }


}
