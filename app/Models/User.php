<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Lamaran;
use App\Models\dashboard_user;
use App\Models\keterampilan;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'email',
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'user_id', 'user_id');
        // punya relasi dengan lowongan many to many
        // user id ad foreign key in lamaran table
    }
    public function dashboard_user()
    {
        return $this->hasOne(dashboard_user::class);
        // punya relasi dengan lowongan many to many
    }

    public function keterampilan(){
        return $this->belongsToMany(keterampilan::class);
    }
}
