<?php

namespace App\Http\Controllers;

use App\Models\PengumumanBankModel;
use Illuminate\Http\Request;
use App\Models\PengumumanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PengumumanController extends Controller
{
    public function buatPengumumanPengambil(Request $request)
    {
        $pengumumanBaru = new PengumumanModel();
        $pengumumanBaru->idPengambil = Auth::id();
        $pengumumanBaru->tanggal = NOW();
        $pengumumanBaru->judulPengumuman = $request->judulPengumuman;
        $pengumumanBaru->isiPengumuman = $request->isiPengumuman;
        $pengumumanBaru->aktif = true;
        $pengumumanBaru->save();
        Session::flash('successBuat', 'Pengumuman Berhasil di Buat');

        return response()->json(['success' => true]);
    }

    public function selesaiPengumumanPengambil(Request $request)
    {
        $pengumuman = PengumumanModel::where("idPengambil", Auth::id())->where("id", $request->id)->first();
        $pengumuman->aktif = false;
        $pengumuman->save();
        return back()->with("successSelesai", "Pengumuman di Non-Aktifkan");
    }

    public function editPengumumanPengambil(Request $request)
    {
        $pengumuman = PengumumanModel::where("idPengambil", Auth::id())->where("id", $request->id)->first();
        $pengumuman->judulPengumuman = $request->judulPengumuman;
        $pengumuman->isiPengumuman = $request->isiPengumuman;
        $pengumuman->save();
        Session::flash('successEdit', 'Pengumuman Berhasil di Edit');

        return response()->json(['success' => true]);
    }

    public function buatPengumumanBank(Request $request)
    {
        $pengumumanBaru = new PengumumanBankModel();
        $pengumumanBaru->idBank = Auth::id();
        $pengumumanBaru->tanggal = NOW();
        $pengumumanBaru->judulPengumuman = $request->judulPengumuman;
        $pengumumanBaru->isiPengumuman = $request->isiPengumuman;
        $pengumumanBaru->aktif = true;
        $pengumumanBaru->save();
        Session::flash('successBuat', 'Pengumuman Berhasil di Buat');

        return response()->json(['success' => true]);
    }

    public function selesaiPengumumanBank(Request $request)
    {
        $pengumuman = PengumumanBankModel::where("idBank", Auth::id())->where("id", $request->id)->first();
        $pengumuman->aktif = false;
        $pengumuman->save();
        return back()->with("successSelesai", "Pengumuman di Non-Aktifkan");
    }

    public function editPengumumanBank(Request $request)
    {
        $pengumuman = PengumumanBankModel::where("idBank", Auth::id())->where("id", $request->id)->first();
        $pengumuman->judulPengumuman = $request->judulPengumuman;
        $pengumuman->isiPengumuman = $request->isiPengumuman;
        $pengumuman->save();
        Session::flash('successEdit', 'Pengumuman Berhasil di Edit');

        return response()->json(['success' => true]);
    }
}
