<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\Kategori;
use App\Models\Owner;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    function owner()
    {

        $user = User::where('email', Session::get('email'))->first();
        $bus = Bus::count('bus.bus_id');
        $owner = Owner::count();
        $transaksi = Transaksi::where('status', 'paid')->count();
        $tiket = Tiket::join('transaksi', 'transaksi.transaksi_id', 'tiket.transaksi_id')->count();
        $jadwal = Jadwal::where('tgl_jalan', '>=', date('Y-m-d'))->count();
        $title = 'Dashboard Owner';

        return view('backend.dashboard-owner', compact('title', 'bus', 'transaksi', 'tiket', 'jadwal', 'user'));
    }
    function admin()
    {

        $bus = Bus::count('bus.bus_id');
        $owner = Owner::count();
        $transaksi = Transaksi::where('status', 'paid')->count();
        $tiket = Tiket::join('transaksi', 'transaksi.transaksi_id', 'tiket.transaksi_id')->count();
        $jadwal = Jadwal::where('tgl_jalan', '>=', date('Y-m-d'))->count();
        $title = 'Dashboard Admin';

        return view('backend.dashboard-admin', compact('title', 'bus', 'owner', 'transaksi', 'jadwal', 'tiket'));
    }

    function gantiPassword()
    {
        $title = 'Ganti Password';
        return view('backend.ganti-password', compact('title'));
    }
}
