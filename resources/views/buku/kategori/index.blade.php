{{-- Halaman utama untuk menampilkan daftar kategori --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Kategori</h1>

    {{-- Menampilkan alert success bila kategori berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan kategori --}}
    <a class="btn btn-secondary mb-2" href="/buku">Kembali</a>
    <a class="btn btn-secondary mb-2" href="/kategori/create">Tambah Kategori</a>

    <div class="mb-3">
        {{-- Tabel daftar kategori --}}
        <table class="table table-stripped"  id="tabelKategori">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data kategori yang ada di database --}}
                @foreach ($allKategori as $kategori)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>
                            <a class= "btn btn-success m-1" href="/kategori/{{ $kategori->id_kategori }}/edit">Edit</a> 
                            {{-- Form delete game --}}
                            {{-- Delete game harus dimasukkan ke dalam form --}}
                            {{-- From akan mengirimkan slug yang akan dikelola method destroy pada controller --}}
                            <form action="/kategori/{{ $kategori->id_kategori }}" method="post">
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
            $('#tabelKategori').dataTable();
        });
    </script>
@endsection