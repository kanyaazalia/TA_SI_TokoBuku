{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Edit Penerbit: {{ $penerbit->nama_penerbit }}</h1>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/penerbit/{{ $penerbit->id_penerbit }}" method="post">
            @method('put')
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="nama_penerbit">Nama Penerbit: </label>
                <input class= "form-control" type="text" name="nama_penerbit" id="nama_penerbit" required autofocus value="{{ old('nama_penerbit', $penerbit->nama_penerbit) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('nama_penerbit')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
@endsection