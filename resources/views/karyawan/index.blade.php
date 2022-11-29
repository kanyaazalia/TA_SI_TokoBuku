{{-- Halaman utama untuk menampilkan daftar karyawan --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Karyawan</h1>

    {{-- Menampilkan alert success bila karyawan berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan karyawan --}}
    <a class="btn btn-secondary mb-2" href="/home">Kembali</a>
    <a class="btn btn-secondary mb-2" href="/karyawan/create">Tambah Karyawan</a>

    <div class="mb-3">
        {{-- Tabel daftar karyawan --}}
        <table class="table table-stripped"  id="tabelKaryawan">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Lapor ke</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data karyawan yang ada di database --}}
                @foreach ($allKaryawan as $karyawan)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->nama_karyawan }}</td>
                        <td>{{ $karyawan->username }}</td>
                        <td>
                            @if ($karyawan->admin === 1)
                                Admin
                            @elseif ($karyawan->admin === 0)
                                User
                            @endif
                        </td>
                        <td>{{ $karyawan->parent->nama_karyawan }}</td>
                        <td> 
                            @if ($karyawan->activated === 1)
                                Aktif
                            @elseif ($karyawan->activated === 0)
                                Tidak Aktif
                            @endif
                        </td>
                        <td>
                            <a class= "btn btn-success m-1" href="/karyawan/{{ $karyawan->username }}/edit">Edit</a> 
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
            $('#tabelKaryawan').dataTable();
        });
    </script>
@endsection