<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        return view('karyawan.index', [
            // Memberikan nilai 'title' untuk halaman
            'title' => 'Daftar Karyawan',

            // Mengambil data karyawan dari database
            'allKaryawan' => Karyawan::orderBy('id_karyawan')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Menampilkan halaman tambah karyawan
    public function create()
    {
        $this->authorize('admin');
        // Mengambalikan halaman view create
        return view('karyawan.create', [
            'title' => 'Tambah Karyawan',
            // Mengambil data admin karyawan
            'adminKaryawan' => Karyawan::get()->where('admin', 1)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Class yang akan menambahkan nilai ke database
    public function store(Request $request)
    {
        $this->authorize('admin');
        // Validasi data yang akan masuk ke database
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|min:3|max:200',
            'username' => 'required|min:3|max:50|unique:karyawan|alpha_dash',
            'password' => 'required|min:3|max:50|alpha_dash',
            'admin' => 'boolean',
            'report_to' => 'integer|min:1|max:11',
            'activated' => 'boolean'
        ]);
        // Password di enkripsi
        $validatedData['password'] = Hash::make($validatedData['password']);
        // Memasukkan data ke tabel karyawan
        Karyawan::create($validatedData);
        // Kembali ke halaman awal dan membawa pesan bernama 'success'
        return redirect('/karyawan')->with('berhasil', 'Karyawan ' . $request['nama_karyawan'] . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        $this->authorize('admin');
        // Mengembalikan view show karyawan
        return view('karyawan.show', [
            // Memberikan nilai 'title' untuk halaman
            'title' => 'Detail Karyawan',

            // Mengambil data karyawan yang akan ditampilkan di halaman edit, berdasarkan username yang dikirim dari URL
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        $this->authorize('admin');
        // Mengembalikan view edit karyawan
        return view('karyawan.edit', [
            // Memberikan nilai 'title' untuk halaman
            'title' => 'Edit Karyawan',
            // Mengambil data karyawan yang akan ditampilkan di halaman edit, berdasarkan username yang dikirim dari URL
            'karyawan' => $karyawan,
            'activated' => $karyawan->activated,
            // Mengambil data admin karyawan
            'adminKaryawan' => Karyawan::get()->where('admin', 1)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $this->authorize('admin');
        // Menentukan peraturan validasi data yang akan di edit
        $rules = [
            'nama_karyawan' => 'required|min:3|max:200',
            'admin' => 'boolean',
            'report_to' => 'integer|min:1|max:11',
            'activated' => 'boolean'
        ];

        // Jika isi barcode yang dimasukkan berbeda dengan barcode yang sudah ada, maka akan dijalankan validasi kembali
        // Menghindari error unique
        if($request->username != $karyawan->username) {
            $rules['username'] = 'required|min:3|max:50|unique:karyawan|alpha_dash';
        }
        // Jika password diisi maka akan diubah
        if($request->filled('password')) {
            $rules['password'] = 'required|min:3|max:50|alpha_dash';
        }
        // Request di validasi menggunakan request yang sudah ada
        $validatedData = $request->validate($rules);
        // Password di enkripsi bila diisi
        if($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        // Mengupdate data yang ada di database dengan data yang sudah di validasi berdasarkan id karyawan yang dikirim lewat URL
        Karyawan::where('id_karyawan', $karyawan->id_karyawan)->update($validatedData);
        // Kembali ke halaman awal dan membawa pesan bernama 'success'
        return redirect('/karyawan')->with('berhasil', 'Karyawan ' . $request['nama_karyawan'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $this->authorize('admin');
        //
    }
}
