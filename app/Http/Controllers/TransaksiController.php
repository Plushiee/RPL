<?php

namespace App\Http\Controllers;

use App\Models\UserBankSampahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserTransaksiModel;
use App\Models\UserTransaksiBankModel;

class TransaksiController extends Controller {
    // File Pembayaran
    public function simpanbukti(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $transaksiId = $request->id_transaksi;
            $fileName = $userId.'_'.$transaksiId.'_bukti.'.$file->getClientOriginalExtension();
            $directory = $userId;

            Storage::disk('secure_bukti')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = UserTransaksiModel::where('id', $request->id_transaksi)->first();
            $transaksi->buktibayar = $fileName;
            $transaksi->terbayar = true;
            $transaksi->save();
            return redirect()->route('pembayaran')->with('berhasil', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('pembayaran')->with('gagal', 'Data Tidak Berhasil disimpan.');
        }
    }

    //antarSendiri
    public function lokasiBank() {
        $locations = UserBankSampahModel::where('id', '!=', Auth::id())->get();

        return response()->json($locations);
    }

    public function lokasiBankIndex() {
        $locations = UserBankSampahModel::get();

        return response()->json($locations);
    }

    public function antarSendiri(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = $userId;

            Storage::disk('secure_antar')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiBankModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->idBank = $request->id;
            $transaksi->jenisSampah = $request->jenisSampah;
            $transaksi->nama = $request->nama;
            $transaksi->nomor = $request->nomor;
            $transaksi->catatanTambahan = $request->catatan;
            $transaksi->berat = $request->berat;
            $transaksi->bukti = $fileName;
            $transaksi->diterima = false;
            $transaksi->terantar = false;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function organik(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'organik/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    //Simpan data kertas
    public function kertas(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'kertas/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Kertas';
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function plastik(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'plastik/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Plastik';
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function kaca(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'kaca/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Kaca';
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function logam(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'logam/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Logam';
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }

    public function lainnya(Request $request) {
        //File bukti
        if($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $userId = Auth::id();
            $fileName = $userId.'_'.time().'_'.$file->getClientOriginalName();
            $directory = 'lainnya/'.$userId;

            Storage::disk('secure_diRumah')->putFileAs($directory, $file, $fileName);
        } else {
            $fileName = null;
        }

        // Simpan data ke database
        if(Auth::check()) {
            $transaksi = new UserTransaksiModel;
            $transaksi->idPemilik = Auth::id();
            $transaksi->jenisSampah = 'Lainnya';
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
            $transaksi->terbayar = false;
            $transaksi->approved = false;
            $transaksi->terambil = false;
            $transaksi->lang = $request->lang;
            $transaksi->long = $request->long;
            $transaksi->save();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Error']);
        }
    }
}
