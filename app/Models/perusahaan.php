<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\lowongan;

class perusahaan extends Model
{
    protected $table = 'perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'email',
        'nomor_npwp',
        'dokumen_legalitas',
        'password',
    ];
    public function lowongans()
    {
        return $this->hasMany(Lowongan::class);
        // punya relasi dengan lowongan many to many
    }
}
