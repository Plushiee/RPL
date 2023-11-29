<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanBankModel extends Model
{
    use HasFactory;

    protected $table = "pengumuman_bank";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idBank',
        'tanggal',
        'judulPengumuman',
        'isiPengumuman',
        'aktif',
    ];
}
