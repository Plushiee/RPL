<?php

namespace App\Http\Controllers;

use App\Models\UserTransaksiBankModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TerimaPesananController extends Controller
{
    public function terimaBank(Request $request)
    {
        $aksi = $request->aksi;
        $id = $request->id_transaksi;

        if ($aksi === "diterima") {
            $kumpulanTransaksi = UserTransaksiBankModel::where('id', $id)->first();
            $kumpulanTransaksi->diterima = true;
            $kumpulanTransaksi->save();
            return back()->with("diterima", "Pesanan Anda Terima");
        }
        else {
            $kumpulanTransaksi = UserTransaksiBankModel::where('id', $id)->first();
            $kumpulanTransaksi->terantar = true;
            $kumpulanTransaksi->save();
            return back()->with("approved", "Pesanan Anda Sudah Diantar");
        }
    }
}
