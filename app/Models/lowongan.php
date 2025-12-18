<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'lowongan_id';
    public $timestamps = true;

    protected $fillable = [
        'perusahaan_id',
        'posisi',
        'persyaratan',
        'kategori_pekerjaan'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'perusahaan_id');
    }
}
