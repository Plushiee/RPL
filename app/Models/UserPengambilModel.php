<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class UserPengambilModel extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;

    protected $table = "pengambilmail";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        // Data Diri
        'berat',
        'namaLengkap',
        'nomor',
        'alamat',
        'kecamatan',
        'kota',
        'provinsi',
        'kodePos',
        'catatan',
        // pembayaran
        'bank',
        'atasNamaBank',
        'norek',
        'ewallet',
        'namaewallet',
        'noewallet',
        'remember_token'
    ];
}
