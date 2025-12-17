<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class keterampilan extends Model
{
    /**
     * Table name explicitly set to match migration (singular).
     */
    protected $table = 'keterampilan';

    /**
     * Primary key in migration is 'keterampilan_id'.
     */
    protected $primaryKey = 'keterampilan_id';

    protected $fillable = [
        'nama_keterampilan'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
        // punya relasi dengan lowongan many to many
    }
}
