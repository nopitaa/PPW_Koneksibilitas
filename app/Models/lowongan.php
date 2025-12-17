<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Perusahaan;
use App\Models\Lamaran;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'lowongan_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'perusahaan_id',
        'posisi',
        'persyaratan',
        'kategori_pekerjaan',
    ];

    // Relasi: Lowongan milik satu perusahaan
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }

    // Relasi: Lowongan memiliki banyak lamaran
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id', 'lowongan_id');
    }
}
