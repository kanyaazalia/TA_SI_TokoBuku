<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        return view('buku.kategori.index', [
            'title' => 'Daftar Kategori',
            'allKategori' => Kategori::orderBy('id_kategori')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('buku.kategori.create', [
            'title' => 'Tambah Kategori',
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
        $this->authorize('admin');
        //Validasi data yang masuk ke database
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        Kategori::create($validatedData);
        
        return redirect('/kategori')->with('berhasil','Kategori ' . $request['nama_kategori'] . ' berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        $this->authorize('admin');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        $this->authorize('admin');
        return view('buku.kategori.edit', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->authorize('admin');
        $rules = [
            'nama_kategori' => 'required|string|max:100',
        ];

        // Data di validasi berdasarkan peraturan yang sudah ditentukan
        $validatedData = $request->validate($rules);

        //Mengupdate data sesuai id yang dikirimkan
        Kategori::where('id_kategori', $kategori->id_kategori)->update($validatedData);
        
        //Kembali ke product dengan pesan berhasil
        return redirect('/kategori')->with('berhasil','Kategori ' . $request['judul_kategori'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $this->authorize('admin');
        //
    }
}
