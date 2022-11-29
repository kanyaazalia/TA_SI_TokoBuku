{{-- Halaman utama untuk menampilkan daftar penulis --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Penulis</h1>

    {{-- Menampilkan alert success bila penulis berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan penulis --}}
    <a class="btn btn-secondary mb-2" href="/buku">Kembali</a>
    <a class="btn btn-secondary mb-2" href="/penulis/create">Tambah Penulis</a>

    <div class="mb-3">
        {{-- Tabel daftar penulis --}}
        <table class="table table-stripped"  id="tabelPenulis">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Penulis</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data penulis yang ada di database --}}
                @foreach ($allPenulis as $penulis)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penulis->nama_penulis }}</td>
                        <td>
                            <a class= "btn btn-success m-1" href="/penulis/{{ $penulis->id_penulis }}/edit">Edit</a> 
                            {{-- Form delete game --}}
                            {{-- Delete game harus dimasukkan ke dalam form --}}
                            {{-- From akan mengirimkan slug yang akan dikelola method destroy pada controller --}}
                            <form action="/penulis/{{ $penulis->id_penulis }}" method="post">
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
            $('#tabelPenulis').dataTable();
        });
    </script>
@endsection