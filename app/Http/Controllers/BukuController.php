<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Pagination\Paginator;

class BukuController extends Controller
{
    public function index() {
        $batas = 5;
        Paginator::useBootstrapFive();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $hitung_data = $data_buku->count();
        $hitung_data = Buku::count();
        $total_harga = $data_buku->sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact('data_buku', 'hitung_data', 'total_harga', 'no'));
    }

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        Paginator::useBootstrapFive();
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->paginate($batas);
        $hitung_data = $data_buku->count();
        $hitung_data = Buku::count();
        $total_harga = $data_buku->sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact('data_buku', 'hitung_data', 'total_harga', 'no', 'cari'));
    }

    public function create() {
        return view('buku.create');
        // mengembalikan ke view buku.create
    }

    public function store(Request $request) {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ], [
            'judul.required' => 'Judul Buku Harus Diisi',
            'penulis.required' => 'Nama Penulis Harus Diisi',
            'penulis.max' => 'Nama Penulis Tidak Boleh Lebih Dari 30 Karakter',
            'harga.required' => 'Harga Buku Harus Diisi',
            'harga.numeric' => 'Harga Buku Harus Berupa Angka',
            'tgl_terbit.required' => 'Tanggal Terbit Harus Diisi',
            'tgl_terbit.date' => 'Tanggal Terbit Harus Berupa Tanggal'
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
        // menerima input req kemudian di redirect ke buku.index
    }

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus');
    }

    // membuat method untuk mnampilkan form update
    public function update($id) {
        $buku = Buku::find($id);

        return view('buku.update', compact('buku'));
    }

    // controller untuk menghandle proses update
    public function edit(Request $request, $id) {
        $buku = Buku::find($id);
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');
        $buku->save();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Diperbarui');
    }
}
