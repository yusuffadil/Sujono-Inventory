<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Hash;

date_default_timezone_set('Asia/Jakarta');

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('barang.*', 'kategori.nama_kategori')
                    ->get();

        $kategori = kategori::all();
        return view('user.master.barang', compact('barang', 'kategori'));
    }

    public function store(Request $request)
    {
        $number = mt_rand(1000000000,9999999999);

        // dd($request, $number);

        Barang::create([
            'id_kategori'   => $request->id_kategori,
            'nama_barang'   => $request->nama_barang,
            'product_code'  => $number,
            'harga'         => $request->harga,
            'stok'          => 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect('/barang')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, string $id)
    {
        $barang = Barang::find($id);

        $barang->id_kategori    = $request->id_kategori;
        $barang->nama_barang    = $request->nama_barang;
        $barang->harga          = $request->harga;
        $barang->stok           = $request->stok;
        $barang->updated_at     = date('Y-m-d H:i:s');
        
        $barang->save();

        return redirect('/barang')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(string $id)
    {
        $barang = Barang::find($id);
 
        $barang->delete();

        return redirect('/barang')->with('success', 'Data Berhasil Dihapus');
    }
}
