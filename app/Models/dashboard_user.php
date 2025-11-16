<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class dashboard_user extends Model
{
    protected $fillable = [
        'foto_profil',
        'jenis_disabilitas',
        'tentang',
        'cv',
        'portofolio',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
        // punya relasi dengan lowongan many to many
    }
}
