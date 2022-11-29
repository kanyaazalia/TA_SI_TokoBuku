<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user');
        return view('buku.penerbit.index', [
            'title' => 'Daftar Penerbit',
            'allPenerbit' => Penerbit::orderBy('id_penerbit')->get()
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
        return view('buku.penerbit.create', [
            'title' => 'Tambah Penerbit',
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
            'nama_penerbit' => 'required|string|max:100',
        ]);

        Penerbit::create($validatedData);
        
        return redirect('/penerbit')->with('berhasil','Penerbit ' . $request['nama_penerbit'] . ' berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penerbit
     * @return \Illuminate\Http\Response
     */
    public function show(Penerbit $penerbit)
    {
        $this->authorize('user');
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penerbit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerbit $penerbit)
    {
        $this->authorize('user');
        return view('buku.penerbit.edit', [
            'title' => 'Edit Penerbit',
            'penerbit' => $penerbit,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penerbit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $this->authorize('user');
        $rules = [
            'nama_penerbit' => 'required|string|max:100',
        ];

        // Data di validasi berdasarkan peraturan yang sudah ditentukan
        $validatedData = $request->validate($rules);

        //Mengupdate data sesuai id yang dikirimkan
        Penerbit::where('id_penerbit', $penerbit->id_penerbit)->update($validatedData);
        
        //Kembali ke product dengan pesan berhasil
        return redirect('/penerbit')->with('berhasil','Penerbit ' . $request['nama_penerbit'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penerbit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit)
    {
        $this->authorize('admin');
        //
    }
}