@extends('auth.layout')

@section('content')
    <section class="p-5">
        @if (Session::has('pesan'))
            <div class="alert alert-success">{{ Session::get('pesan') }}</div>
        @endif

        <h1 class="text-center">Daftar Buku</h1>
        <div>
            <form action="{{ route('buku.search') }}" method="GET">
                @csrf
                <input type="text" name="kata" class="form-control w-25 d-inline float-right mb-3 mt-3"
                    placeholder="Cari...">
            </form>
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

                                <a href="{{ route('buku.update', $buku->id) }}"
                                    class="btn btn-primary float-end">Update</a>

                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                    <th scope="row" colspan="3" class="table-active table-primary border-black">Jumlah Harga</th>
                    <td colspan="3">{{'Rp. '.number_format($totalPrice,  2, '.', '.')}}</td>
                </tr>
                <tr>
                    <th scope="row" colspan="3" class="table-active table-primary border-black">Banyak Data</th>
                    <td colspan="3">{{$countbuku}}</td>
                </tr> --}}
                </tbody>
            </table>
        </div>

        <div>
            {{ $data_buku->links() }}
        </div>

    </section>

    {{-- <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script> --}}
@endsection
