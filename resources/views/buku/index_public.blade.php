@extends('auth.layout')

@section('content')

<div class="container mt-5">
    <a href="{{ route('login') }}" class="brn brn-success btn-sm">
        Login Admin
    </a>
    <h1 class="text-center">Daftar Buku</h1>
    <table class="table table-light table-hover" id="datatable">
        <thead class="">
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp. ".number_format($buku->harga, 2, '.', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <p><strong>Jumlah Total Buku:</strong> {{ $hitung_data }} </p>
        <p><strong>Jumlah Total Harga:</strong> {{ "Rp. ".number_format($total_harga, 0, ',', '.') }} </p>
    </div>
</div>

@endsection
