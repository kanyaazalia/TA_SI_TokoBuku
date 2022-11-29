{{-- Halaman utama untuk menampilkan daftar buku --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Buku</h1>

    {{-- Menampilkan alert success bila buku berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan buku --}}
    <a class="btn btn-secondary mb-2" href="/home">Kembali</a>
    <a class="btn btn-secondary mb-2" href="/buku/create">Tambah Buku</a>
    <a class="btn btn-secondary mb-2" href="/kategori">Kategori</a>
    <a class="btn btn-secondary mb-2" href="/penerbit">Penerbit</a>
    <a class="btn btn-secondary mb-2" href="/penulis">Penulis</a>

    <div class="mb-3">
        {{-- Tabel daftar buku --}}
        <table class="table table-stripped"  id="tabelBuku">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Jumlah Stok</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data buku yang ada di database --}}
                @foreach ($allBuku as $buku)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->id_kategori }}</td>
                        <td>{{ $buku->id_penulis }}</td>
                        <td>{{ $buku->id_penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>Rp{{ number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ $buku->diskon }}</td>
                        <td>{{ $buku->jumlah_stok }}</td>
                        <td> 
                            @if ($buku->discontinue === 0)
                                Aktif
                            @elseif ($buku->discontinue === 1)
                                Tidak Aktif
                            @endif
                        </td>
                        <td>
                            <a class= "btn btn-success m-1" href="/buku/{{ $buku->id_buku }}/edit">Edit</a> 
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
            $('#tabelBuku').dataTable();
        });
    </script>
@endsection