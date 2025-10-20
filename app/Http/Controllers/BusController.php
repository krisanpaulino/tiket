<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Jadwal;
use App\Models\Rute;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BusController extends Controller
{
    function index()
    {
        $title = 'Data Bus';
        $user = User::where('email', Session::get('email'))->first();
        $bus = Bus::orderBy('bus_id', 'desc')->get();
        return view('backend.bus_index', compact('bus', 'title'));
    }

    function tambah()
    {
        $title = 'Tambah Produk';
        return view('backend.bus_form', compact('title'));
    }
    function store(Request $request): RedirectResponse
    {
        //Validasi
        $validated = $request->validate([
            // 'nama_bus' => 'required',
            'no_plat' => 'required',
            'jumlah_kursi' => 'required',
        ]);
        // dd($path);

        $validated['nama_bus'] = 'Paris Indah';
        Bus::insert($validated);

        return redirect(route('bus.index'))->with('message', 'successToast("Bus ditambahkan")');
    }
    function update(Request $request): RedirectResponse
    {
        $bus_id = $request->bus_id;
        //Validasi
        $validated = $request->validate([
            // 'nama_bus' => 'required',
            'no_plat' => 'required',
            'jumlah_kursi' => 'required',
        ]);

        $bus = Bus::find($bus_id);
        // dd($validated);
        $bus->update($validated);

        return redirect(route('bus.index'))->with('message', 'successToast("Bus diupdate")');
    }

    function delete(Request $request)
    {
        $bus_id = $request->bus_id;
        Bus::destroy($bus_id);
        return back()->with('success', 'Data bus berhasil dihapus')->with('message', 'successToast("Data bus berhasil dihapus")');
    }

    //Untuk Admin

    function jadwal($bus_id)
    {
        $title = 'Data Bus';
        $rute = Rute::all();
        $user = User::where('email', Session::get('email'))->first();
        $bus = Bus::find($bus_id);
        // dd($bus_id);
        $jadwal = Jadwal::join('bus', 'bus.bus_id', 'jadwal.bus_id')->where('bus.bus_id', $bus->bus_id)->get();
        return view('backend.jadwal_index', compact('jadwal', 'title', 'bus', 'rute'));
    }
    function jadwalAll()
    {
        $title = 'Data Bus';
        $user = User::where('email', Session::get('email'))->first();
        // dd($bus_id);
        $jadwal = Jadwal::orderBy('tgl_jalan', 'desc')->where('tgl_jalan', '>=', date('Y-m-d'))->get();
        return view('backend.jadwal_index', compact('jadwal', 'title'));
    }


    function storeJadwal(Request $request): RedirectResponse
    {
        //Validasi
        $validated = $request->validate([
            'bus_id' => 'required',
            'tgl_jalan' => 'required',
            'jam_jalan' => 'required',
            'jam_sampai' => 'required',
            'rute_id' => 'required',
        ]);
        // dd($validated);
        // $user = User::where('email', Session::get('email'))->first();

        Jadwal::insert($validated);

        return redirect(route('jadwal.index', $validated['bus_id']))->with('message', 'successToast("Jadwal ditambahkan")');
    }
    function updateJadwal(Request $request): RedirectResponse
    {
        // dd($request->all());
        $jadwal_id = $request->jadwal_id;
        //Validasi
        $validated = $request->validate([
            'bus_id' => 'required',
            'tgl_jalan' => 'required',
            'jam_jalan' => 'required',
            'jam_sampai' => 'required',
            'rute_id' => 'required',
        ]);
        // $user = User::where('email', Session::get('email'))->first();

        $jadwal = Jadwal::find($jadwal_id);
        $jadwal->update($validated);

        return redirect(route('jadwal.index', $validated['bus_id']))->with('message', 'successToast("Jadwal diubah")');
    }

    function deleteJadwal(Request $request)
    {
        $jadwal_id = $request->jadwal_id;
        Jadwal::destroy($jadwal_id);
        return back()->with('success', 'Data jadwal berhasil dihapus')->with('message', 'successToast("Data jadwal berhasil dihapus")');
    }

    function rute()
    {
        $title = 'Rute';
        // dd($bus_id);

        $rute = Rute::all();
        return view('backend.rute_index', compact('rute', 'title'));
    }

    function storeRute(Request $request): RedirectResponse
    {
        //Validasi
        $validated = $request->validate([
            'asal' => 'required',
            'tujuan' => 'required',
            'harga' => 'required',
        ]);

        if (Rute::where('asal', $validated['asal'])->where('tujuan', $validated['tujuan'])->exists()) {
            return back()->with('message', 'dangerToast("Rute sudah ada")')->withInput();
        }
        // $user = User::where('email', Session::get('email'))->first();

        Rute::insert($validated);

        return redirect(route('rute.index'))->with('message', 'successToast("Jadwal ditambahkan")');
    }
    function updateRute(Request $request): RedirectResponse
    {
        // dd($request->all());
        $rute_id = $request->rute_id;
        //Validasi
        $validated = $request->validate([
            // 'asal' => 'required',
            // 'tujuan' => 'required',
            'harga' => 'required',
        ]);
        // $user = User::where('email', Session::get('email'))->first();

        $rute = Rute::find($rute_id);
        $rute->update($validated);

        return redirect(route('rute.index'))->with('message', 'successToast("Rute diubah")');
    }
    function deleteRute(Request $request)
    {
        $rute_id = $request->rute_id;
        Rute::destroy($rute_id);
        return back()->with('success', 'Data Rute berhasil dihapus')->with('message', 'successToast("Data Rute berhasil dihapus")');
    }
}
