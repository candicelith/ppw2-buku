@extends('auth.layout')

@section('content')

    <body class="bg-dark text-light p-2">
        <div class="container">
            <h4>Update Buku</h4>
            {{-- membuat form update --}}
            {{-- buku update yang put krn itu utk update --}}
            <form method="POST" action="{{ route('buku.edit', $buku->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <!-- atribut judul adalah key dan inputan value -->
                    <input type="text" class="form-control" name="judul">
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" name="penulis">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga">
                </div>
                <div class="form-group">
                    <label for="tgl_terbit">Tanggal Terbit</label>
                    <input type="date" id="tgl_terbit" class="date form-control" name="tgl_terbit"
                        placeholder="yyyy/mm/dd">
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" class="form-control" name="photo">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </body>
@endsection
