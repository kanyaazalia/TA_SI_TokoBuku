{{-- Halaman utama untuk menampilkan daftar penerbit --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Penerbit</h1>

    {{-- Menampilkan alert success bila penerbit berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan penerbit --}}
    <a class="btn btn-secondary mb-2" href="/buku">Kembali</a>
    <a class="btn btn-secondary mb-2" href="/penerbit/create">Tambah Penerbit</a>

    <div class="mb-3">
        {{-- Tabel daftar penerbit --}}
        <table class="table table-stripped"  id="tabelPenerbit">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Penerbit</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data penerbit yang ada di database --}}
                @foreach ($allPenerbit as $penerbit)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penerbit->nama_penerbit }}</td>
                        <td>
                            <a class= "btn btn-success m-1" href="/penerbit/{{ $penerbit->id_penerbit }}/edit">Edit</a> 
                            {{-- Form delete game --}}
                            {{-- Delete game harus dimasukkan ke dalam form --}}
                            {{-- From akan mengirimkan slug yang akan dikelola method destroy pada controller --}}
                            <form action="/penerbit/{{ $penerbit->id_penerbit }}" method="post">
                                {{-- "Membajak" form agar menggunakan method delete --}}
                                {{-- Sesuai dokumentasi untuk controller resource --}}
                                {{-- Agar terjaga dari Cross Site Scripting --}}
                                @csrf
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('scripts')
        <script>
        $(document).ready(function(){
            $('#tabelPenerbit').dataTable();
        });
    </script>
@endsection