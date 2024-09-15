<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index() {
        $data_buku = Buku::all()->sortBy('id');

        $hitung_data = $data_buku->count();

        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'hitung_data', 'total_harga'));
    }
}
