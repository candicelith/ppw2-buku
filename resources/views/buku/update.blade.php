@extends('auth.layout')

@section('content')
<body class="bg-dark text-light p-2">
    <div class="container">
        <h4>Update Buku</h4>
        {{-- membuat form update --}}
        {{-- buku update yang put krn itu utk update--}}
        <form method="POST" action="{{ route('buku.edit', $buku->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
            </div>
            <div class="form-group">
                <label for="tgl_terbit">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
@endsection
