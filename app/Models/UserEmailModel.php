<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class UserEmailModel extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;

    protected $table = "useremail";

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'status'
    ];
}
