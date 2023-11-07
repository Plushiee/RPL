<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaksiModel extends Model
{
    use HasFactory;

    protected $table = "user_transaksi";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idPemilik',
        'jenisSampah',
        'nama',
        'nomor',
        'alamat',
        'kecamatan',
        'kota',
        'provinsi',
        'kodePos',
        'catatan',
        'berat',
        'bukti',
        'lang',
        'long',
    ];
}
