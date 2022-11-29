<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user');
        return view('buku.penulis.index', [
            'title' => 'Daftar Penulis',
            'allPenulis' => Penulis::orderBy('id_penulis')->get()
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
        return view('buku.penulis.create', [
            'title' => 'Tambah Penulis',
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
            'nama_penulis' => 'required|string|max:100',
        ]);

        Penulis::create($validatedData);
        
        return redirect('/penulis')->with('berhasil','Penulis ' . $request['nama_penulis'] . ' berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penulis
     * @return \Illuminate\Http\Response
     */
    public function show(Penulis $penulis)
    {
        $this->authorize('user');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penulis
     * @return \Illuminate\Http\Response
     */
    public function edit(Penulis $penulis)
    {
        $this->authorize('user');
        return view('buku.penulis.edit', [
            'title' => 'Edit Penulis',
            'penulis' => $penulis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penulis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penulis $penulis)
    {
        $this->authorize('user');
        $rules = [
            'nama_penulis' => 'required|string|max:100',
        ];

        // Data di validasi berdasarkan peraturan yang sudah ditentukan
        $validatedData = $request->validate($rules);

        //Mengupdate data sesuai id yang dikirimkan
        Penulis::where('id_penulis', $penulis->id_penulis)->update($validatedData);
        
        //Kembali ke product dengan pesan berhasil
        return redirect('/penulis')->with('berhasil','Penulis ' . $request['judul_penulis'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penulis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penulis $penulis)
    {
        $this->authorize('admin');
        //
    }
}
