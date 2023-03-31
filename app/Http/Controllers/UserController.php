<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

date_default_timezone_set('Asia/Jakarta');

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.master.user', compact('user'));
    }

    public function store(Request $request)
    {
        // dd($request);
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password?$request->password:Auth::user()->password),
            'level'         => $request->level,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $user->level         = $request->level;
        $user->updated_at    = date('Y-m-d H:i:s');
        
        $user->save();

        return redirect('/user')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
 
        $user->delete();

        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
}
