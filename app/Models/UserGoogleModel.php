<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGoogleModel extends Model
{
    use HasFactory;

    protected $table = "usersgoogle";

    protected $fillable = [
        'google_id',
        'email',
        'name',
        'profile_picture',
    ];

    
}
