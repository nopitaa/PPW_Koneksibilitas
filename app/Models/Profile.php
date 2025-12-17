<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 
        'name',
        'subtitle',
        'about',
        'skills',
        'avatar_path',
        'cv_path',
        'resume_path',
        'portfolio_path',
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
