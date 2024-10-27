@extends('auth.layout')

@section('content')
<body class="p-2">
    <div class="container">
        <h4>Tambah Buku</h4>
        <!-- form method POST untuk memasukkan buku ke db dgn route buku.store-->
        <form method="POST" action="{{ route('buku.store') }}">
            @csrf
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
                <input type="date" id="tgl_terbit" class="date form-control" name="tgl_terbit" placeholder="yyyy/mm/dd">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ '/buku' }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>
@endsection
