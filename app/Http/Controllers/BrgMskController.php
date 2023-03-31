<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BrgMsk;
use App\Models\Kategori;

date_default_timezone_set('Asia/Jakarta');

class BrgMskController extends Controller
{
    public function index()
    {
        $brg_masuk = BrgMsk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                    ->get();

        $barang = Barang::all();
        return view('user.transaksi.brg_masuk.barang_masuk', compact('barang', 'brg_masuk'));
    }

    public function create()
    {
        $barang = Barang::all();

        return view('user.transaksi.brg_masuk.add', compact('barang'));
    }

    public function ajax(Request $request)
    {
        $id_barang['id_barang'] =   $request->id_barang;
        $ajax_barang            =   Barang::where('id', $id_barang)->get();

        return view('user.transaksi.brg_masuk.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {
        BrgMsk::create([
            'no_brg_masuk'  => $request->no_brg_masuk,
            'id_barang'     => $request->id_barang,
            'id_user'       => $request->id_user,
            'tgl_brg_masuk' => $request->tgl_brg_masuk,
            'jml_brg_masuk' => $request->jml_brg_masuk,
            'total'         => $request->total,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        $barang = Barang::find($request->id_barang);

        $barang->stok    += $request->jml_brg_masuk;        
        $barang->save();

        return redirect('/barang_masuk')->with('success', 'Data Berhasil Disimpan');
    }
}
