<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class UserBankSampahModel extends Model implements Authenticatable
{
    use HasFactory;
    use HasFactory;
    use AuthenticableTrait;

    protected $table = "banksampahmail";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idUserMail',
        'name',
        'email',

        // Data Diri
        'nomor',
        'alamat',
        'kecamatan',
        'kota',
        'provinsi',
        'kodePos',
        'catatan',
        'kapasitas',
        // 'tampung',
        'lang',
        'long',
    ];
}
