{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Tambah Buku</h1>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/buku" method="post">
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="judul_buku">Judul Buku: </label>
                <input class= "form-control" type="text" name="judul_buku" id="judul_buku" required autofocus value="{{ old('judul_buku') }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('judul_buku')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="form-group">
                <label for="slug">Slug/URL: </label>
                <input class= "form-control" type="text" name="slug" id="slug" required value="{{ old('slug') }}"> --}}

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                {{-- @error('slug')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="id_penerbit">Penerbit: </label>
                <select class= "form-control" id="id_penerbit" name="id_penerbit">
                    @foreach($allPenerbit as $penerbit)
                        @if (old('id_penerbit') == $penerbit->id_penerbit)
                            <option value="{{ $penerbit->id_penerbit }}" selected>{{ $penerbit->nama_penerbit }}</option>
                        @else
                            <option value="{{ $penerbit->id_penerbit }}">{{ $category->nama_penerbit }}</option>
                        @endif
                    @endforeach
                  </select>

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('id_penerbit')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_penulis">Penerbit: </label>
                <select class= "form-control" id="id_penulis" name="id_penulis">
                    @foreach($allPenulis as $penulis)
                        @if (old('id_penulis') == $penulis->id_penulis)
                            <option value="{{ $penulis->id_penulis }}" selected>{{ $penulis->nama_penulis }}</option>
                        @else
                            <option value="{{ $penulis->id_penulis }}">{{ $category->nama_penulis }}</option>
                        @endif
                    @endforeach
                  </select>

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('id_penulis')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_penerbit">Penerbit: </label>
                <select class= "form-control" id="id_penerbit" name="id_penerbit">
                    @foreach($allPenerbit as $penerbit)
                        @if (old('id_penerbit') == $penerbit->id_penerbit)
                            <option value="{{ $penerbit->id_penerbit }}" selected>{{ $penerbit->nama_penerbit }}</option>
                        @else
                            <option value="{{ $penerbit->id_penerbit }}">{{ $category->nama_penerbit }}</option>
                        @endif
                    @endforeach
                  </select>

                  {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                  @error('id_penerbit')
                  <div>
                      {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit: </label>
                    <input class= "form-control" type="date" name="tahun_terbit" id="tahun_terbit" required value="{{ old('tahun_terbit') }}">
    
                    {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                    @error('tahun_terbit')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="harga">Harga: </label>
                    <input class= "form-control" type="number" name="harga" id="harga" required value="{{ old('harga') }}" placeholder="Rp.">
    
                    {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                    @error('harga')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            <div class="form-group">
                <label for="diskon">Diskon: </label>
                <input class= "form-control" type="text" name="diskon" id="diskon" required value="{{ old('diskon') }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('diskon')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_stok">Jumlah Stok: </label>
                <input class= "form-control" type="text" name="jumlah_stok" id="jumlah_stok" required value="{{ old('jumlah_stok') }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('jumlah_stok')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <div class="container-input form-group">
                    <label for="discontinue">Discontinue: </label>
                    <input class="form-check-input" type="hidden" name="discontinue" value="0"/>
                    <input class="form-check-input" type="checkbox" name="discontinue" value="1" {{ old('discontinue') ? 'checked="checked"' : '' }}>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
@endsection