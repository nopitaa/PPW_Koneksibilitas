<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'lowongan_id';

    protected $fillable = [
        'perusahaan_id',
        'posisi',
        'persyaratan',
        'kategori_pekerjaan',
        'status', 
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id', 'lowongan_id');
    }

    protected $casts = [
        'created_at'  => 'datetime',
    ];
}
