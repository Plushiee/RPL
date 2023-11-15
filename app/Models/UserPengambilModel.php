<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPengambilModel extends Model
{
    use HasFactory;

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
    ];
}
