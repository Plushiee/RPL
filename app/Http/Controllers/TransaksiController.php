<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserTransaksiModel;

class TransaksiController extends Controller
{
    //Simpan data organik
    public function organik(Request $request)
    {
        //File bukti
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk('secure_diRumah')->put($fileName, file_get_contents($file));
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if (Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Organik';
            $transaksi->nama = $request->nama;
            $transaksi->nomor = $request->nomor;
            $transaksi->alamat = $request->alamat;
            $transaksi->kecamatan = $request->kecamatan;
            $transaksi->kota = $request->kota;
            $transaksi->provinsi = $request->provinsi;
            $transaksi->kodePos = $request->kodePos;
            $transaksi->catatan = $request->catatan;
            $transaksi->berat = $request->berat;
            $transaksi->bukti = $fileName;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }
}
