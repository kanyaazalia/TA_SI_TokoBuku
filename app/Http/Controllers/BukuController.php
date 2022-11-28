<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('user');
        return view('buku.index', [
            'title' => 'Daftar Buku',
            'allBuku' => Buku::orderBy('id_buku')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('user');
        return view('buku.create', [
            'title' => 'Tambah Buku',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('user');
        //Validasi data yang masuk ke database
        $validatedData = $request->validate([
            'judul_buku' => 'required|string|max:100',
            'id_kategori' => 'required|integer|max:11',
            'id_penulis' => 'required|integer|max:11',
            'id_penerbit' => 'required|integer|max:11',
            'tahun_terbit' => 'required|integer|max:11',
            'harga' => 'required|integer|max:11',
            'diskon' => 'required|integer|max:11',
            'jumlah_stok' => 'required|integer|max:11',
            'discontinue' => 'boolean'
        ]);

        Buku::create($validatedData);
        
        return redirect('/buku')->with('berhasil','Buku ' . $request['judul_buku'] . ' berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        $this->authorize('user');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        $this->authorize('user');
        return view('buku.edit', [
            'title' => 'Edit Buku',
            'buku' => $buku,
            'id_kategori' => Kategori::all(),
            'id_penulis' => Penulis::all(),
            'id_penerbit' => Penerbit::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $this->authorize('user');
        $rules = [
            'judul_buku' => 'required|string|max:100',
            'id_kategori' => 'required|integer|max:11',
            'id_penulis' => 'required|integer|max:11',
            'id_penerbit' => 'required|integer|max:11',
            'tahun_terbit' => 'required|integer|max:11',
            'harga' => 'required|integer|max:11',
            'diskon' => 'required|integer|max:11',
            'jumlah_stok' => 'required|integer|max:11',
            'discontinue' => 'boolean'
        ];

        // Data di validasi berdasarkan peraturan yang sudah ditentukan
        $validatedData = $request->validate($rules);

        //Mengupdate data sesuai id yang dikirimkan
        Buku::where('id_buku', $buku->id_buku)->update($validatedData);
        
        //Kembali ke product dengan pesan berhasil
        return redirect('/buku')->with('berhasil','Buku ' . $request['judul_buku'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        $this->authorize('admin');
        //
    }
}

