<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\Rute;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    function jadwalByRute(Request $request)
    {
        $rute_id = $request->rute;
        $jadwal = Jadwal::where('rute_id', $rute_id)
            ->where('tgl_jalan', '>=', date('Y-m-d'))
            ->orderBy('tgl_jalan', 'asc')
            ->groupBy('tgl_jalan')
            ->get();

        echo json_encode($jadwal);
    }
    function jadwalByTanggal(Request $request)
    {
        $tanggal = $request->tanggal;

        $jadwal = Jadwal::where('tgl_jalan', $tanggal)
            ->orderBy('jam_jalan', 'asc')
            ->groupBy('jam_jalan')
            ->get();

        echo json_encode($jadwal);
    }
    function busByJadwal(Request $request)
    {
        $tanggal = $request->tanggal;
        $jam = $request->jam;

        $jadwal = Jadwal::with('bus')
            ->where('tgl_jalan', $tanggal)
            ->where('jam_jalan', $jam)
            ->groupBy('bus_id')
            ->get();

        echo json_encode($jadwal);
    }

    function cekKursi(Request $request)
    {
        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $bus = $request->bus;
        $rute = $request->rute;

        $input = [
            'tanggal' => $tanggal,
            'jam' => $jam,
            'bus' => $bus,
            'rute' => $rute,
        ];
        $jadwal = Jadwal::where('tgl_jalan', $tanggal)
            ->where('jam_jalan', $jam)
            ->where('bus_id', $bus)
            ->where('rute_id', $rute)
            ->first();
        $booked = Transaksi::where('jadwal_id', $jadwal->jadwal_id)->sum('jumlah_tiket');
        $bus = Bus::find($bus);

        $available = $bus->jumlah_kursi - $booked;
        $data['available'] = $available;
        $data['jadwal_id'] = $jadwal->jadwal_id;
        echo json_encode($input);
    }

    function getHarga(Request $request)
    {
        $rute = $request->rute;
        $kursi = $request->kursi;

        $dataRute = Rute::find($rute);
        $total = $dataRute->harga * $kursi;

        $data = [
            'totalinput' => $total,
            'total' => number_format($total)
        ];

        echo json_encode($data);
    }
}
