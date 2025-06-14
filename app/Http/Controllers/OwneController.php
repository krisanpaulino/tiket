<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwneController extends Controller
{
    function index()
    {
        $title = 'Data Owner';
        $owner = Owner::all();
        return view('backend.owner_index', compact('owner', 'title'));
    }
    // function view($id)
    // {
    //     $petani = Petani::find($id);
    //     $title = 'Detail Petani';
    //     return view('backend.petani_detail', compact('petani', 'title'));
    // }
    // function edit($id)
    // {
    //     $petani = Petani::find($id);
    //     $title = 'Detail Petani';
    //     return view('backend.petani_edit', compact('petani', 'title'));
    // }
    // function tambah()
    // {
    //     // $petani = Petani::find($id);
    //     $title = 'Tambah Petani';
    //     return view('backend.petani_tambah', compact('title'));
    // }
    // function update(Request $request): RedirectResponse
    // {

    //     //Validasi
    //     $validated = $request->validate([
    //         'petani_nama' => 'required',
    //         'petani_hp' => 'required',
    //         'petani_jk' => 'required',
    //         'petani_tempatlahir' => 'required',
    //         'petani_tgllahir' => 'required',
    //         'petani_alamat' => 'required',

    //     ]);
    //     $petani_id = $request->petani_id;
    //     if (Session::get('type') == 'admin') {
    //         $petani = Petani::find($petani_id);
    //         // dd('here');
    //         $userdata = $request->validate([
    //             'username' => ['required', Rule::unique('user', 'username')->ignore($petani->user->user_id, 'user_id')]
    //         ]);

    //         $user = new User();
    //         $user->find($petani->user->user_id);
    //         $user->update($userdata);
    //     }
    //     if (Session::get('type') == 'petani') {
    //         $userdata = $request->validate([
    //             'username' => ['required', Rule::unique('user', 'username')->ignore(Session::get('user_id'), 'user_id')],
    //             'user_password' => 'required|confirmed:password_confirmation',
    //             'password_confirmation' => 'required'
    //         ]);
    //         unset($userdata['password_confirmation']);
    //         $userdata['user_password'] = Hash::make($userdata['user_password']);

    //         $user = new User();
    //         $user->find($petani->user->user_id);
    //         $user->update($userdata);
    //     }
    //     $petani = Petani::find($petani_id);
    //     $petani->update($validated);


    //     return back();
    // }


    function insert(Request $request): RedirectResponse
    {

        //Validasi
        $validated = $request->validate([
            'nama_owner' => 'required',
            'alamat_owner' => 'required',
            'hp_owner' => 'required',
        ]);
        $userdata = $request->validate([
            'email' => 'required|unique:user,email',
            'user_password' => 'required|confirmed:password_confirmation',
            'password_confirmation' => 'required'
        ]);
        unset($userdata['password_confirmation']);
        $userdata['user_type'] = 'owner';
        // dd($userdata['user_password']);
        $userdata['user_password'] = Hash::make($userdata['user_password']);

        $user = new User();
        $user->fill($userdata);

        $user->save();

        $validated['user_id'] = $user->user_id;
        Owner::insert($validated);

        return redirect(route('owner.index'));
    }

    // function delete(Request $request)
    // {
    //     $petani_id = $request->petani_id;
    //     Petani::destroy($petani_id);
    //     return back()->with('success', 'Data petani berhasil dihapus')->with('message', 'successToast("Data petani berhasil dihapus")');
    // }
}
