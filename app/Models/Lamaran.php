<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lowongan;
use App\Models\User;

class Lamaran extends Model
{
    protected $primaryKey = 'lamaran_id';

    protected $table = 'lamaran';
    
    protected $fillable = [
    'user_id',
    'lowongan_id',
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
    'status', 
];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id', 'lowongan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
