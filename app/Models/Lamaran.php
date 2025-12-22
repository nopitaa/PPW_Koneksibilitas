<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lowongan;
use App\Models\User;

class Lamaran extends Model
{
    protected $table = 'lamaran';
    
    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'nomor_hp',
        'alamat_lengkap',
        'email',
        'pendidikan',
        'nama_institusi',
        'jurusan',
        'th_start',
        'th_end',
        'alat_bantu',
        'cv',
        'resume',
        'portofolio',
    ];

    public function lowongans()
    {
        return $this->belongsTo(Lowongan::class);
        // punya relasi dengan lowongan many to many
    }

    public function users()
    {
        return $this->belongsTo(User::class);
        // punya relasi dengan lowongan many to many
    }
}
