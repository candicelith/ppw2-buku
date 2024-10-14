@extends('layout.master')

@section('content')
<body class="bg-dark p-5 text-light">

    @if (Session::has('pesan'))
    <div class="alert alert-success">
        {{ Session::get('pesan') }}
    </div>
    @endif

    <h1 class="text-center">Daftar Buku</h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end mt-3 mb-3">Tambah Buku</a>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">id</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Penulis</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp." .number_format($buku->harga, 2, ',', '.') }}</td>
                    {{-- <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('buku.update', $buku->id) }}">
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-light">
        <div>{{ $data_buku->links() }}</div>
        <h1>Jumlah data yang ada adalah: </h1>
        <p>{{ $hitung_data }}</p>
        <h1>Total harga semua buku adalah: </h1>
        <p>{{ "Rp." .number_format($total_harga, 2, ',', '.') }}</p>
    </div>
</body>
@endsection
