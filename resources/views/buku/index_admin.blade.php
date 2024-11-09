@extends('auth.layout')

@section('content')
    <section class="p-5">
        @if (Session::has('pesan'))
            <div class="alert alert-success">{{ Session::get('pesan') }}</div>
        @endif

        <h1 class="text-center">Daftar Buku</h1>
        <div>
            <a href="{{ route('buku.create') }}" class="btn btn-primary float-end my-3">Tambah Buku</a>
            <table class="table-light table-hover table" id="datatable">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                        <th>Hapus</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_buku as $index => $buku)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src=" {{ asset('storage/' . $buku->photo) }} " alt="photo"></td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ 'Rp. ' . number_format($buku->harga, 2, '.', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                            <td>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin mau di hapus?')" type="submit"
                                        class="btn btn-danger">
                                        Hapus
                                    </button>

                                </form>
                            </td>
                            <td>

                                <a href="{{ route('buku.update', $buku->id) }}" class="btn btn-primary float-end">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <p><strong>Jumlah Total Buku:</strong> {{ $hitung_data }} </p>
            <p><strong>Jumlah Total Harga:</strong> {{ 'Rp. ' . number_format($total_harga, 0, ',', '.') }} </p>
        </div>

        {{-- <div>
        {{$data_buku->links()}}
    </div> --}}

    </section>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
