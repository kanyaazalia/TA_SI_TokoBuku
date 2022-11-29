{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Edit Buku: {{ $buku->judul_buku }}</h1>
    <a class="btn btn-secondary mb-2" href="/buku">Kembali</a>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/buku" method="post">
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="judul_buku">Judul Buku: </label>
                <input class= "form-control" type="text" name="judul_buku" id="judul_buku" required autofocus value="{{ old('judul_buku', $buku->judul_buku) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('judul_buku')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_kategori">Kategori: </label>
                <select class= "form-control" id="id_kategori" name="id_kategori">
                    @foreach($allKategori as $kategori)
                        @if (old('id_kategori') == $kategori->id_kategori)
                            <option value="{{ $kategori->id_kategori }}" selected>{{ $kategori->nama_kategori }}</option>
                        @else
                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                        @endif
                    @endforeach
                  </select>

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('id_kategori')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_penulis">Penulis: </label>
                <select class= "form-control" id="id_penulis" name="id_penulis">
                    @foreach($allPenulis as $penulis)
                        @if (old('id_penulis') == $penulis->id_penulis)
                            <option value="{{ $penulis->id_penulis }}" selected>{{ $penulis->nama_penulis }}</option>
                        @else
                            <option value="{{ $penulis->id_penulis }}">{{ $penulis->nama_penulis }}</option>
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
                            <option value="{{ $penerbit->id_penerbit }}">{{ $penerbit->nama_penerbit }}</option>
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
                    <input class= "form-control" type="number" min="0" name="tahun_terbit" id="tahun_terbit" required value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
    
                    {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                    @error('tahun_terbit')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="form-group">
                    <label for="harga">Harga: </label>
                    <input class= "form-control" type="number" min="0" name="harga" id="harga" required value="{{ old('harga', $buku->harga) }}" placeholder="Rp.">
    
                    {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                    @error('harga')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            <div class="form-group">
                <label for="diskon">Diskon: </label>
                <input class= "form-control" type="number" min="0" name="diskon" id="diskon" required value="{{ old('diskon', $buku->diskon) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('diskon')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_stok">Jumlah Stok: </label>
                <input class= "form-control" type="number" min="0" name="jumlah_stok" id="jumlah_stok" required value="{{ old('jumlah_stok', $buku->jumlah_stok) }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('jumlah_stok')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="status" class="">Status: </label> <br>
                <div class="form-check form-check-inline container-input form-group">
                    <div class="form-check form-switch">
                        <input type="checkbox" id="discontinue" value="discontinue">
                        <label class="form-check-label" for="discontinue">Discontinue</label>
                      </div>
                    <div>
                    @error('discontinue')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div><br>

            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
@endsection