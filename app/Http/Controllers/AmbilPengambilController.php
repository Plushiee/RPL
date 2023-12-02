<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTransaksiModel;
use Illuminate\Support\Facades\Auth;

class AmbilPengambilController extends Controller
{
    public function ambilPengambilSave(Request $request)
    {
        $aksi = $request->aksi;
        $id = $request->id_transaksi;

        try {
            if ($aksi === "diterima") {
                $kumpulanTransaksi = UserTransaksiModel::where('id', $id)->first();
                $kumpulanTransaksi->diterima = true;
                $kumpulanTransaksi->idPengambil = Auth::id();
                $kumpulanTransaksi->save();
                return back()->with("diterima", "Pesanan Anda Terima");
            } else if ($aksi === "approved") {
                $kumpulanTransaksi = UserTransaksiModel::where('id', $id)->first();
                $kumpulanTransaksi->approved = true;
                $kumpulanTransaksi->save();
                return back()->with("approved", "Pembayaran Anda Approved");
            } else {
                $kumpulanTransaksi = UserTransaksiModel::where('id', $id)->first();
                $kumpulanTransaksi->terambil = true;
                $kumpulanTransaksi->save();
                return back()->with("diterima", "Pesanan Anda Ambil");
            }
        } catch (\Exception $e) {
            \Log::error("Error in ambilPengambilSave: " . $e->getMessage());

            return back()->with("error", "An error occurred. Please try again.");
        }
    }

}
