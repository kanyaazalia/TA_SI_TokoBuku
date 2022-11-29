{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Edit Penulis {{ $penulis->nama_penulis }}</h1>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/penulis/{{ $penulis->id_penulis }}" method="post">
            @method('put')
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="nama_penulis">Nama Penulis: </label>
                <input class= "form-control" type="text" name="nama_penulis" id="nama_penulis" required autofocus value="{{ old('nama_penulis', $penulis->nama_penulis) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('nama_penulis')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
@endsection