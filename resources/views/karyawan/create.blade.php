{{-- Halaman utama untuk menambahkan game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Tambah Karyawan</h1>
    <a class="btn btn-secondary mb-2" href="/karyawan">Kembali</a>

    {{-- Form penambahan game --}}
    <div class="form-group">
        <form action="/karyawan" method="post">
            {{-- Untuk mencegah terjadinya Cross Site Scripting --}}
            @csrf

            {{-- Field untuk menambahkan data produk --}}
            <div class="form-group">
                <label for="nama_karyawan">Nama Karyawan: </label>
                <input class= "form-control" type="text" name="nama_karyawan" id="nama_karyawan" required autofocus value="{{ old('nama_karyawan') }}">

                {{-- Jika data yang diisikan tidak sesuai validasi maka akan mengembalikan pesan error --}}
                @error('nama_karyawan')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="container-input form-group">
                <label for="username">Username: </label>
                <input class="form-control form-control-sm" type="text" name="username" id="username" required value="{{ old('username') }}" required>

                @error('username')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="container-input form-group">
                <label for="password">Password: </label>
                <input class="form-control form-control-sm" type="password" name="password" id="password" required value="{{ old('password') }}" required>

                @error('password')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="admin" class="">Admin: </label>
                <div class="form-check form-check-inline container-input form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="hidden" name="admin" value="0"/>
                        <input class="form-check-input" type="checkbox" name="admin" value="1" {{ old('admin') ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="admin"></label>
                      </div>
                    <div>
                    @error('admin')
                        <div>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div><br>

            <div class="container-input form-group">
                <label for="report_to">Lapor ke: </label>
                <select class="form-control form-control-sm" id="report_to" name="report_to" onfocus="this.size=5" onblur="this.size=1" onchange="this.size=1; this.blur();">
                    @foreach($adminKaryawan as $karyawan)
                        @if (old('report_to') == $karyawan->id_karyawan)
                            <option value="{{ $karyawan->id_karyawan }}" selected>{{ $karyawan->nama_karyawan }}</option>
                        @else
                            <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama_karyawan }}</option>
                        @endif
                    @endforeach
                  </select>

                @error('report_to')
                    <div>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div>
                <label for="activated" class="">Aktif: </label>
                <div class="form-check form-check-inline container-input form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="hidden" name="activated" value="0"/>
                        <input class="form-check-input" type="checkbox" name="activated" value="1" {{ old('activated') ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="activated"></label>
                      </div>
                    <div>
                    @error('activated')
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