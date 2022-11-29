{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Edit Kategori {{ $kategori->nama_kategori }}</h1>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/kategori/{{ $kategori->id_kategori }}" method="post">
            @method('put')
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori: </label>
                <input class= "form-control" type="text" name="nama_kategori" id="nama_kategori" required autofocus value="{{ old('nama_kategori', $kategori->nama_kategori) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('nama_kategori')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
@endsection