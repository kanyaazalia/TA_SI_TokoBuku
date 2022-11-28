@extends('layouts.main')

@section('container')
    {{-- Menampilkan nama user yang login --}}

    <div class="wrapper">
        <h1 class="mb-3">Selamat datang, {{ auth()->user()->nama_karyawan }}.</h1>

        <div class="d-grid gap-1 mb-3">
            {{-- href ke halaman lain --}}
            @can('admin')
                <a class="btn btn-secondary"  href="/karyawan">Daftar Karyawan</a><br>
            @endcan

            <a class="btn btn-secondary"  href="/buku">Daftar Buku</a><br>

            <a class="btn btn-secondary" href="/transaksi">Daftar Transaksi</a><br>
        </div>
        {{-- Form untuk logout --}}
        <form action="/logout" method="post" style="margin-top:15px">
            {{-- Menghindari cross site scripting --}}
            @csrf

            {{-- Button untuk logout --}}
            <button class="btn btn-danger btn-sm" type="submit">Logout</button>
        </form>
    </div>
@endsection