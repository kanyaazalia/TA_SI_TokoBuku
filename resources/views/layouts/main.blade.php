{{-- Layout utama --}}

<!DOCTYPE html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />

    {{-- Title menerima kiriman variabel berdasarkan route yang dituju --}}
    <title>Toko Buku | {{ $title }}</title>
</head>
<body>
    {{-- Link ke halaman /games atau /categories --}}

    {{-- <div class="btn-group btn-group-lg" role="group">
        <a class="btn btn-primary rounded-0 {{ Request::is('games*') ? 'active' : '' }}" href="/games">Games</a>
        <a class="btn btn-primary rounded-right {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">Categories</a>
    </div> --}}

    <div class="container">
        @yield('container')
    </div>
    
    {{-- Memanggil JQuery versi Lama --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}

    {{-- Memanggil JQuery --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    {{-- Memanggil JQuery DataTable --}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    {{-- Memanggil Bootsrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    @yield('scripts')
</body>
</html>