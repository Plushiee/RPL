<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaksiBankModel extends Model
{
    use HasFactory;

    protected $table = "transaksi_bank";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idPemilik',
        'idPemilik',
        'jenisSampah',
        'nama',
        'nomor',
        'catatanTambahan',
        'bukti',
        'approved',
        'terkirim',
        'bankSampah',
        'alamat',
        'lang',
        'long',
    ];
}
