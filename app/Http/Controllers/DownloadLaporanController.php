<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\PengumumanBankModel;
use App\Models\PengumumanModel;
use App\Models\UserTransaksiBankModel;
use App\Models\UserEmailModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTransaksiModel;
use App\Models\UserBankSampahModel;
use App\Models\UserPengambilModel;
use Carbon\Carbon;
use Spatie\Browsershot\Browsershot;

class DownloadLaporanController extends Controller
{
    public function downloadLaporanPemilik(Request $request)
    {
        $jenisLaporan = $request->laporan;
        $tanggalMulai = $request->startDate;
        $tanggalAkhir = $request->endDate;

        if ($jenisLaporan === "ambilDirumah") {
            $query = UserTransaksiModel::where('idPemilik', Auth::id())->orderBy('id', 'asc');

            if ($tanggalMulai && $tanggalAkhir) {
                $query->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalAkhir . ' 23:59:59']);
            }

            $kumpulanTransaksi = $query->get();

            return view('PDF-laporan-pemilik-ambilDirumah', [
                'kumpulanTransaksi' => $kumpulanTransaksi,
                'tanggalMulai' => $tanggalMulai,
                'tanggalAkhir' => $tanggalAkhir,
            ]);
        } else {
            $query = UserTransaksiBankModel::join('banksampahmail', 'transaksi_bank.idBank', '=', 'banksampahmail.id')
                ->where('transaksi_bank.idPemilik', Auth::id())
                ->orderBy('transaksi_bank.id', 'asc');

            if ($tanggalMulai && $tanggalAkhir) {
                $query->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalAkhir . ' 23:59:59']);
            }

            $kumpulanTransaksi = $query->get(['transaksi_bank.jenisSampah', 'transaksi_bank.berat', 'transaksi_bank.id as idTransaksi', 'transaksi_bank.updated_at as tanggalTransaksi', 'banksampahmail.*']);

            return view('PDF-laporan-pemilik-antarSendiri', [
                'kumpulanTransaksi' => $kumpulanTransaksi,
                'tanggalMulai' => $tanggalMulai,
                'tanggalAkhir' => $tanggalAkhir,
            ]);
        }

    }

    public function downloadLaporanPengambil()
    {
        $labels = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $currentYear = now()->year;

        // Query database untuk mendapatkan data transaksi hanya untuk tahun ini
        $data = UserTransaksiModel::where('approved', true)
            ->where('terambil', true)
            ->where('idPengambil', Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->rightJoin(DB::raw("(SELECT 1 as month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) as months"), function ($join) {
                $join->on(DB::raw('MONTH(created_at)'), '=', 'months.month');
            })
            ->groupBy('jenisSampah', 'months.month')
            ->select(
                'jenisSampah',
                \DB::raw('count(*) as totalTransactions'),
                \DB::raw('months.month as month'),
            )
            ->orderBy('month')
            ->get();

        $userLocations = UserTransaksiModel::where('approved', true)
            ->where('idPengambil', Auth::user()->id)
            ->where('terambil', true)
            ->whereYear('created_at', $currentYear)
            ->get(['nama', 'alamat', 'lang', 'long']);

        $transactionsPerMonth = array_fill(0, 12, 0);

        foreach ($data as $entry) {
            $monthIndex = $entry->month - 1;
            $transactionsPerMonth[$monthIndex] = $entry->totalTransactions;
        }

        $years = UserTransaksiModel::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->where('terambil', true)
            ->where('idPengambil', Auth::user()->id)
            ->orderBy('year')
            ->get()
            ->pluck('year');

        // Get the HTML content from the view
        return view('PDF-laporan-pengambil', [
            'jenisSampah' => json_encode($data->pluck('jenisSampah')->toArray()),
            'totalTransactions' => json_encode($data->pluck('totalTransactions')->toArray()),
            'labels' => json_encode($labels),
            'transactionsPerMonth' => json_encode($transactionsPerMonth),
            'userLocations' => $userLocations,
            'years' => $years,
        ]);
    }
}
