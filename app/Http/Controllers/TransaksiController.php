<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Rute;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    function halamanPesan()
    {
        $rute = Rute::all();
        $title = 'Pesan Tiket';
        return view('frontend.pesan', compact('rute', 'title'));
    }

    function pesanPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'rute_id' => 'required',
            'tgl_jalan' => 'required',
            'jam_jalan' => 'required',
            'bus_id' => 'required',
            'jadwal_id' => 'required',
            'jumlah_tiket' => 'required',
        ]);
        $user = User::where('email', Session::get('email'))->first();
        // $rute = Rute::find
        $jadwal = Jadwal::find($validated['jadwal_id']);
        $bus = $jadwal->bus;

        $total = $validated['jumlah_tiket'] * $jadwal->rute->harga;
        //Mindtrans
        \Midtrans\Config::$serverKey = 'SB-Mid-server-y0kYrE2DPn-tpSxXDXiWIyQh';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order_id = rand();
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $user->penumpang->nama_penumpang,
                'email' => $user->email,
                'phone' => $user->penumpang->no_hp,
            ),

            "redirect_url" => route('paid')

        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $dataTransaksi = [
            'penumpang_id' => $user->penumpang->penumpang_id,
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'jumlah_tiket' => $validated['jumlah_tiket'],
            'status' => 'unpaid',
            'token' => $snapToken,
            'order_id' => $order_id,
            'jadwal_id' => $validated['jadwal_id'],
            'total' => $total
        ];

        $transaksi = new Transaksi();
        $transaksi->fill($dataTransaksi);
        $transaksi->save();



        //Buat Detail tiket berdasarkan jumlah kursi
        $no_kursi = 1;
        $counter = 0;
        while ($counter < $validated['jumlah_tiket'] && $no_kursi <= $bus->jumlah_kursi) {
            $tiket = Tiket::where('transaksi_id', $transaksi->transaksi_id)
                ->where('no_kursi', $no_kursi)->first();
            if ($tiket == null) {
                $dataTiket = [
                    'transaksi_id' => $transaksi->transaksi_id,
                    'kode_booking' => Str::random(5),
                    'status_checkin' => 0,
                    'no_kursi' => $no_kursi
                ];
                Tiket::insert($dataTiket);
                $counter++;
            }
            $no_kursi++;
        }


        return redirect(route('pembayaran', $transaksi->transaksi_id));
    }

    function pembayaran($id)
    {
        $transaksi = Transaksi::find($id);
        return view('frontend.pembayaran', compact('transaksi'));
    }
    function paid(Request $request)
    {
        $order_id = $request->order_id;
        $transaksi = Transaksi::where('order_id', $order_id);
        $transaksi->update([
            'status' => 'paid'
        ]);
        // dd('success');
        return redirect(route('tiket', $order_id));
    }

    function tiket($order_id)
    {
        $transaksi = Transaksi::where('order_id', $order_id)->first();
        if ($transaksi->status == 'unpaid')
            return redirect(route('pembayaran', $transaksi->transaksi_id));
        $title = 'Data Tiket';
        return view('frontend.tiket', compact('transaksi', 'title'));
    }

    function daftarTransaksi()
    {
        $user = User::where('user_id', Session::get('user_id'))->first();
        // dd(Session::get('email'));
        if ($user->user_type == 'penumpang') {
            $transaksi = Transaksi::where('penumpang_id', $user->penumpang->penumpang_id)->orderBy('tgl_pesan', 'desc')->get();

            $title = 'History Transaksi Saya';

            return view('frontend.transaksi', compact('transaksi', 'title'));
        }

        $transaksi = Transaksi::orderBy('tgl_pesan', 'desc')->get();

        $title = 'Daftar Transaksi';

        return view('backend.transaksi', compact('transaksi', 'title'));
    }

    function detailTransaksi($transaksi_id)
    {
        $transaksi = Transaksi::where('transaksi_id', $transaksi_id)->first();
        $tiket = $transaksi->tiket;
        $title = 'Detail Transaksi';
        return view('backend.transaksi-detail', compact('transaksi', 'title', 'tiket'));
    }
}
