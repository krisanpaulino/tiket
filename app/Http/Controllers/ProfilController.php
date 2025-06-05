<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Penumpang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    function profil()
    {
        $user = User::where('email', Session::get('email'))->first();
        $title = 'Profil';
        return view('frontend.profil', compact('user', 'title'));
    }
    function owner()
    {
        $user = User::where('email', Session::get('email'))->first();
        $title = 'Profil';
        return view('backend.profil', compact('user', 'title'));
    }
    function update(Request $request)
    {
        $penumpang_id = $request->penumpang_id;
        $validated = $request->validate([
            'nama_penumpang' => 'required',
            'jk_penumpang' => 'required',
            'no_hp' => 'required',
            'alamat_penumpang' => 'required',
        ]);
        $penumpang = Penumpang::find($penumpang_id);
        $penumpang->update($validated);
        return redirect(route('profil'));
    }
    function updateOwner(Request $request)
    {
        $owner_id = $request->owner_id;
        $validated = $request->validate([
            'nama_owner' => 'required',
            'alamat_owner' => 'required',
            'hp_owner' => 'required',
        ]);
        $owner = Owner::find($owner_id);
        $owner->update($validated);
        return redirect(route('profile.owner'));
    }
}
