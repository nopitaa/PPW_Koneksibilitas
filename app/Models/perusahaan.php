<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\lowongan;

class perusahaan extends Model
{
    protected $fillable = [
        'nama_perusahaan',
        'alama',
        'email',
        'nomor_npwp',
        'dokumen_legalitas',
    ];
    public function lowongans()
    {
        return $this->hasMany(Lowongan::class);
        // punya relasi dengan lowongan many to many
    }
}
