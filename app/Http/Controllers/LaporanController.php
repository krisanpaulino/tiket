<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    function laporanPage(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $title = 'Laporan';

        // dd($sampai);

        $model = Transaksi::select('*');

        if ($dari != null)
            $model->where(DB::raw('CAST(tgl_pesan AS DATE)'), '>=', $dari);
        if ($sampai != null)
            $model->where(DB::raw('CAST(tgl_pesan AS DATE)'), '<=', $sampai);
        $laporan = $model->get();

        // dd($laporan);


        return view('backend.laporan', compact('laporan', 'dari', 'sampai', 'title'));
    }

    function cetak(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $title = 'Laporan';

        // dd($dari);

        $model = Transaksi::select('*');
        if (Session::get('type') == 'owner') {
            $user = User::where('email', Session::get('email'))->first();

            $model->join('jadwal', 'jadwal.jadwal_id',  'transaksi.jadwal_id');
            $model->join('bus', 'bus.bus_id',  'jadwal.bus_id');
            $model->where('bus.owner_id', $user->owner->owner_id);
        }
        if ($dari != null && $dari != '')
            $model->where(DB::raw('CAST(tgl_pesan AS DATE)'), '>=', $dari);
        if ($sampai != null && $sampai != '')
            $model->where(DB::raw('CAST(tgl_pesan AS DATE)'), '<=', $sampai);
        $laporan = $model->get();
        $data = [
            'title' => 'Laporan Transaksi',
            'tanggal' => date('Y-m-d'),
            'laporan' => $laporan,
            'dari' => $dari,
            'sampai' => $sampai
        ];
        // dd($laporan);
        // return view('backend.laporan_pdf', $data);
        $pdf = Pdf::loadView('backend.laporan_pdf', $data);

        return $pdf->download('laporan-transaksi.pdf');
    }

    function cetakTiket($transaksi_id)
    {
        $transaksi = Transaksi::where('transaksi_id', $transaksi_id)->first();
        $tiket = $transaksi->tiket;

        $data['tiket'] = $tiket;
        $data['transaksi'] = $transaksi;
        $pdf = Pdf::loadView('tiket-pdf', $data);

        return $pdf->download('Tiket-' . $transaksi->order_id . '.pdf');
    }
}
