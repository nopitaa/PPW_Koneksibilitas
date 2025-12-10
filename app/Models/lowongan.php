<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\perusahaan;
use App\Models\Lamaran;


class lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'lowongan_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'posisi',
        'persyaratan',
        'kategori_pekerjaan',
    ];
    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class);
        // punya relasi dengan lowongan many to many
    }
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class);
        // punya relasi dengan lowongan many to many
    }
}
