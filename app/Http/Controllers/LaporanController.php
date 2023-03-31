<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\BrgMsk;
use App\Models\BrgKeluar;
// use App\Models\Kategori;

class LaporanController extends Controller
{
    public function lap_user()
    {
        $user = User::all();
        return view('user.laporan.user.lap_user', compact('user'));
    }

    public function cetak_user()
    {
        $user = User::all();
        return view('user.laporan.user.cetak_user', compact('user'));
    }

    public function lap_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('barang.*', 'kategori.nama_kategori')
                    ->get();
        return view('user.laporan.barang.lap_barang', compact('barang'));
    }

    public function cetak_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('barang.*', 'kategori.nama_kategori')
                    ->get();
        return view('user.laporan.barang.cetak_barang', compact('barang'));
    }

    public function lap_brg_masuk()
    {
        $brg_masuk = BrgMsk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                    ->get();

        return view('user.laporan.brg_masuk.lap_brg_masuk', compact('brg_masuk'));
    }

    public function cetak_brg_masuk(Request $request)
    {
        $tgl_laporan   = $request->tgl_laporan;

        if($tgl_laporan) {
            $brg_masuk = BrgMsk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                        ->where('brg_masuk.tgl_brg_masuk', [$tgl_laporan])
                        ->get();

            $sum_total = BrgMsk::where('tgl_brg_masuk', [$tgl_laporan])->sum('total');
        } else {
            $brg_masuk = BrgMsk::join('barang', 'barang.id', '=', 'brg_masuk.id_barang')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                        ->get();
        }

        return view('user.laporan.brg_masuk.cetak_brg_masuk', compact('brg_masuk', 'sum_total', 'tgl_laporan'));
    }

    public function lap_brg_keluar()
    {
        $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                        ->get();

        return view('user.laporan.brg_keluar.lap_brg_keluar', compact('brg_keluar'));
    }

    public function cetak_brg_keluar(Request $request)
    {
        $tgl_laporan    = $request->tgl_laporan;

        if($tgl_laporan) {
            $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                        ->where('brg_keluar.tgl_brg_keluar', [$tgl_laporan])
                        ->get();

            $sum_total = BrgKeluar::where('tgl_brg_keluar', [$tgl_laporan])->sum('total');
        } else {
            $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_barang')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_barang')
                        ->get();
        }

        return view('user.laporan.brg_keluar.cetak_brg_keluar', compact('brg_keluar', 'sum_total', 'tgl_laporan'));
    }
}
