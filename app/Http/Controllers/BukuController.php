<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

Paginator::useBootstrapFive();

class BukuController extends Controller
{

    public function indexpublic()
    {
        Paginator::useBootstrapFive();
        $data_buku = Buku::orderBy('id', 'desc')->get();
        $hitung_data = $data_buku->count();
        $total_harga = $data_buku->sum('harga');
        return view('buku.index_public', compact('data_buku', 'hitung_data', 'total_harga'));
    }

    public function indexadmin()
    {
        if (Auth::check()) {
            Paginator::useBootstrapFive();
            $data_buku = Buku::orderBy('id', 'desc')->get();
            $hitung_data = $data_buku->count();
            $total_harga = $data_buku->sum('harga');
            return view('buku.index_admin', compact('data_buku', 'hitung_data', 'total_harga'));
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Silahkan Login Terlebih Dahulu',
        ])->onlyInput('email');

    }

    public function index()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $hitung_data = $data_buku->count();
        $hitung_data = Buku::count();
        $total_harga = $data_buku->sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact(
            'data_buku',
            'hitung_data',
            'total_harga',
            'no'
        ));
    }

    public function search(Request $request) {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.index', compact('data_buku', 'hitung_data', 'total_harga', 'no', 'cari'));
    }

    public function create()
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'Silahkan Login Terlebih Dahulu',
        //     ])->onlyInput('email');
        // }
        return view('buku.create');
        // mengembalikan ke view buku.create
    }

    public function store(Request $request)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'Silahkan Login Terlebih Dahulu',
        //     ])->onlyInput('email');
        // }

        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'photo' => 'image|nullable|max:1999'
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

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('public/photos', $filenameSimpan);
        }

        $buku->photo = $path;
        $buku->save();

        return redirect()->route('buku.index.admin')->with('pesan', 'Data Buku Berhasil Disimpan');
        // menerima input req kemudian di redirect ke buku.index
    }


    // membuat method untuk mnampilkan form update
    public function update($id)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'Silahkan Login Terlebih Dahulu',
        //     ])->onlyInput('email');
        // }

        $buku = Buku::find($id);

        return view('buku.update', compact('buku'));
    }

    // controller untuk menghandle proses update
    public function edit(Request $request, $id)
    {
        // if (!(Auth::check())) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => 'Silahkan Login Terlebih Dahulu',
        //     ])->onlyInput('email');
        // }

        $validatedData = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'photo' => 'image|nullable|max:1999'
        ], [
            'judul.required' => 'Judul Buku Harus Diisi',
            'penulis.required' => 'Nama Penulis Harus Diisi',
            'penulis.max' => 'Nama Penulis Tidak Boleh Lebih Dari 30 Karakter',
            'harga.required' => 'Harga Buku Harus Diisi',
            'harga.numeric' => 'Harga Buku Harus Berupa Angka',
            'tgl_terbit.required' => 'Tanggal Terbit Harus Diisi',
            'tgl_terbit.date' => 'Tanggal Terbit Harus Berupa Tanggal'
        ]);

        $buku = Buku::find($id);
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('public/photos', $filenameSimpan);
        }

        $buku->photo = $path;
        $buku->save();

        return redirect()->route('buku.index.admin')->with('pesan', 'Data Buku Berhasil Diperbarui');
    }

        public function destroy($id)
    {
        $buku = Buku::find($id);

        if ($buku && $buku->photo) {
            File::delete(public_path() . 'photos/' . $buku->photo);
        }
        $buku->delete();

        return redirect()->route('buku.index.admin')->with('pesan', 'Data Buku Berhasil Dihapus');
    }

}
