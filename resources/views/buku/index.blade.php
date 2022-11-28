{{-- Halaman utama untuk menampilkan daftar game --}}

{{-- Halaman ini berada di dalam layout utama --}}
@extends('layouts.main')

{{-- Bagian yang akan ditampilkan pada section 'container' dalam layout utama --}}
@section('container')
    <h1>Daftar Buku</h1>

    {{-- Menampilkan alert success bila game berhasil ditambahkan/dietdit --}}
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Link untuk menambahkan game --}}
    <a class="btn btn-secondary mb-2" href="/games/create">Add Game</a>

    <div class="mb-3">
        {{-- Tabel daftar game --}}
        <table class="table table-stripped"  id="gamesTable">
            {{-- Heading tabel --}}
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Developer</th>
                    <th>Publisher</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th class="col-lg-2">Release Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop untuk menampilkan data game yang ada di database --}}
                @foreach ($games as $game)
                    {{-- Isi tabel --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $game->name }}</td>
                        <td>{{ $game->developer }}</td>
                        <td>{{ $game->publisher }}</td>
                        <td>{{ $game->category->name }}</td>
                        <td>Rp{{ number_format($game->price, 2, ',', '.') }}</td>
                        <td class="col-lg-2">{{ $game->release_date }}</td>
                        <td>
                            <a class= "btn btn-success m-1" href="/games/{{ $game->slug }}/edit">Edit</a> 
                            | 

                            {{-- Form delete game --}}
                            {{-- Delete game harus dimasukkan ke dalam form --}}
                            {{-- From akan mengirimkan slug yang akan dikelola method destroy pada controller --}}
                            <form action="/games/{{ $game->slug }}" method="post">
                                {{-- "Membajak" form agar menggunakan method delete --}}
                                {{-- Sesuai dokumentasi untuk controller resource --}}
                                @method('delete')

                                {{-- Agar terjaga dari Cross Site Scripting --}}
                                @csrf

                                {{-- Tombol untuk delete game --}}
                                {{-- Akan menampilkan alert untuk meyakinkan user apakah ingin delete game --}}
                                <button class="btn btn-danger delete m-1" onclick="return confirm(`Are you sure you want to delete '{{ $game->name }}' ?`)">Delete</button>
                            </form>
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
            $('#gamesTable').dataTable();
        });
    </script>
@endsection