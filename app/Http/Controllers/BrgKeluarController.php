<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\Kategori;

date_default_timezone_set('Asia/Jakarta');

class BrgKeluarController extends Controller
{
    public function index()
    {
        $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                    ->get();

        $barang = Barang::all();
        return view('user.transaksi.brg_keluar.barang_keluar', compact('barang', 'brg_keluar'));
    }

    public function create()
    {
        $barang = Barang::all();

        return view('user.transaksi.brg_keluar.add', compact('barang'));
    }

    public function ajax(Request $request)
    {
        $id_barang['id_barang'] =   $request->id_barang;
        $ajax_barang            =   Barang::where('id', $id_barang)->get();

        return view('user.transaksi.brg_keluar.ajax', compact('ajax_barang'));
    }

    public function store(Request $request)
    {
        

        $barang = Barang::find($request->id_barang);

        if($barang->stok < $request->jml_brg_keluar)
        {
            return redirect('/barang_keluar/create')->with('error', 'Jumlah Barang Melebihi Stok');
        }
        else 
        {
            BrgKeluar::create([
                'no_brg_keluar' => $request->no_brg_keluar,
                'id_barang'     => $request->id_barang,
                'id_user'       => $request->id_user,
                'tgl_brg_keluar' => $request->tgl_brg_keluar,
                'jml_brg_keluar'=> $request->jml_brg_keluar,
                'total'         => $request->total,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
            
            $barang->stok    -= $request->jml_brg_keluar;        
            $barang->save();
    
            return redirect('/barang_keluar')->with('success', 'Data Berhasil Disimpan');
        }
    }
}
