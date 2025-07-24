<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    function checkin(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_booking' => 'required',
        ]);
        $kode = $validated['kode_booking'];
        $transaksi = Transaksi::where('kode_booking', $kode)->first();
        if ($transaksi == null)
            return back()->with('message', "dangerToast('Tiket tidak ditemukan!')");

        if ($transaksi->status_checkin == '0') {
            $transaksi->update(['status_checkin' => 1]);
        } else {
            return redirect(route('checkin'))->with('message', "dangerToast('Kode booking sudah check in!')");
        }
        return redirect(route('checkin', $transaksi->transaksi_id))->with('message', "successToast('Berhasil check in!')");
    }

    function checkinPage($tiket_id = null)
    {
        $title = 'Checkin Tiket';
        if ($tiket_id != null) {
            $tiket = Tiket::find($tiket_id);
            return view('backend.checkin', compact('title', 'tiket'));
        }
        return view('backend.checkin', compact('title'));
    }
}
