<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Input\Input;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user');

        // Mengembalikan view karyawan
        return view('transaksi.index', [
            // Memberikan nilai 'title' untuk halaman
            'title' => 'Daftar Transaksi',
            // Mengambil data transaksi dari database
            'allTransaksi' => Transaksi::orderBy('tgl_tutup')->with(['id_karyawan'])->get()
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

        // Mengambalikan halaman view create
        return view('transaksi.create', [
            'title' => 'Buat Transaksi',
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
        $validateData = $request->validate([
        ]);

        // Mengambil id user yang sedang login untuk data EMPPART_ID
        $validateData['id_karyawan'] = auth()->user()->id_karyawan;

        //Memasukkan data ke tabel products
        Transaksi::create($validateData);

        //Jika berhasil membuat transaksi, langsung di arahkan ke halaman detail
        return redirect('/transaksi')->with('berhasil', 'Transaksi ' . $request['id_transaksi'] . ' berhasil di buat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $this->authorize('user');

        // Jika transaksi sudah tutup, maka tidak akan bisa akses halaman ini
        if($transaksi['tutup'] == 1) {
            abort(403);
        }

        return view('transaksi.edit', [
            'title' => 'Edit Transaksi',
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $this->authorize('user');

        // Jika transaksi sudah tutup, maka tidak akan bisa akses halaman ini
        if($transaksi['tutup'] == 1) {
            abort(403);
        }

        // $rules = [
        //     'CUSTOMER_ID2' => 'required',
        //     'CASH' => 'boolean',
        //     'PCAR' => 'boolean',
        //     'RETUR' => 'boolean',
        // ];

        // Karena slug harus unique, dan terkadang user tidak mengubah isi slug, maka harus ditangani dengan pengondisian
        // Bila nilai slug yang lama sama dengan yang baru maka slug akan dibiarkan masuk
        // Tetapi bila slug yang lama berbeda dengan yang baru, maka akan di validasi keunikannya
        if($request->id_transaksi != $transaksi->id_transaksi) {
            $rules['id_transaksi'] = 'required';
        }

        // Setelah rules ditentukan (slug akan di validasi atau tidak), validasi data baru dijalankan
        $validatedData = $request->validate($rules);

        // Dicari game dengan id yang dikirimkan, kemudian di update dengan data yang telah divalidasi
        Transaksi::where('id_transaksi', $transaksi->id_transaksi)->update($validatedData);

        // User dikembalikan ke halaman '/transaksi' dengan pesan success
        return redirect('/transaksi')->with('berhasil', 'Transaksi ' . $request['id_transaksi'] . ' berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $this->authorize('admin');
        
        // Jika transaksi sudah tutup, maka tidak akan bisa akses halaman ini
        if($transaksi['tutup'] == 1) {
            abort(403);
        }
    }

    // Method untuk menutup transaksi
    public function tutup($id_transaksi)
    {
        $this->authorize('user');

        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->get();

        // Jika transaksi sudah tutup, maka tidak akan bisa akses halaman ini
        if($transaksi[0]['tutup'] == 1) {
            abort(403);
        }
        
        // Mencari data transaksi dengan nomor transaksi yang sama dengan yang dikirim lewat URL
        // Lalu update bagian TUTUP dan DATA_TUTUP dari waktu update
        Transaksi::where('id_transaksi', $id_transaksi)->update([
            'tutup' => 1,
            'tgl_tutup' => date('Y-m-d')
        ]);

        return redirect('/transaksi')->with('berhasil', 'Transaksi ' . $id_transaksi . ' berhasil di tutup.');
    }

    // Method untuk menampilkan halaman detail product transaksi
    public function detail(Request $request, $id_transaksi)
    {
        $this->authorize('user');

        $loop = $request['loop'];
        $transaksi = Transaksi::get()->where('id_transaksi', $id_transaksi);
        $transaksi_id = $transaksi[$loop]['id_transaksi'];
        $tutup = $transaksi[$loop]['tutup'];

        return view('transaksi.detail', [
            'title' => 'Detail Transaksi',
            'transaksi_id' => $transaksi_id,
            'tutup' => $tutup,
            'allDetailTransaksi' => DetailTransaksi::get()->where('id_transaksi', $transaksi_id),
            'allBuku' => Buku::orderBy('id_buku')->with('kategori','penulis','penerbit')->get(),
            'allTransaksi' => DetailTransaksi::where('id_transaksi', $transaksi_id)->sum('harga')
        ]);
    }

    // // Method untuk menampilkan invoice
    // public function invoice(Request $request, $transaksi_no)
    // {
    //     $this->authorize('user');

    //     $loop = $request['loop'];
    //     $transaksi = Transaksi::get()->where('id_transaksi', $transaksi_no);
    //     $transaksi_id = $transaksi[$loop]['id_transaksi'];
    //     $tutup = $transaksi[$loop]['tutup'];

    //     $data = [
    //         'title' => 'Print Transaksi',
    //         'transaksi_no' => $transaksi_no,
    //         'transaksi_id' => $transaksi_id,
    //         'tutup' => $tutup,
    //         'total' => DB::table('mtransaksi')->where('COUNTER_ID2', $transaksi_id)->sum('SLSPRC'),
    //         'seluruhTransaksi' => Transaksi::get()->where('COUNTER_ID2', $transaksi_id),
    //         'seluruhmTransaksi' => mTransaksi::get()->where('COUNTER_ID2', $transaksi_id),
    //         'seluruhProducts' => Products::orderBy('PRODUCT_ID2')->with('pgroup')->get(),
    //     ];

    //     $pdf = PDF::loadView('user.transaksi.invoice', $data);

    //     return $pdf->setPaper('A4', 'portrait')->stream('invoice.pdf');
    // }

    public function addBuku(Request $request, $transaksi_no)
    {
        $this->authorize('user');

        $minimal_stock = $request['jumlah_stok'];
        $harga_minimal = $request['harga'] * $request['jumlah_stok'] * $request['diskon'] / 100;

        $validateData = $request->validate([
            'id_transaksi' => 'required',
            'id_buku' => 'required',
            'jumlah_stok' => 'required|integer|min:1|max:' . $minimal_stock,
            'harga' => 'required|integer' . $harga_minimal,
        ]);

        $stock_sisa = $minimal_stock - $validateData['jumlah_stok'];

        $product = Buku::where('id_buku', $validateData['id_buku'])->get();
        $product_id = $product[0]['id_buku'];

        Buku::where('id_buku', $product_id)->update([
            'jumlah_stok' => $stock_sisa
        ]);

        DetailTransaksi::create($validateData);

        return back();
    }

    // Method untuk delete mTransaksi dalam transaksi
    public function deleteBuku(Request $request, $transaksi_no)
    {
        $this->authorize('user');

        $product_id = $request['id_buku'];
        $product = Buku::get()->where('id_buku', $product_id);
        $no_product = $product_id - 1;
        
        $product_stock = $product[$no_product]['jumlah_stok'];
        $jumlah_mTransaksi = $request['jumlah_stok'];
        $stock_kembali = $product_stock + $jumlah_mTransaksi;
        
        Buku::where('id_buku', $product_id)->update([
            'jumlah_stok' => $stock_kembali
        ]);

        DetailTransaksi::destroy($request->id_buku);

        return back();
    }
}
