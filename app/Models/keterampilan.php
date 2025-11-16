<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class keterampilan extends Model
{
    protected $fillable = [
        'nama_keterampilan'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
        // punya relasi dengan lowongan many to many
    }
}
