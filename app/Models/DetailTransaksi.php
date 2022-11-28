<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    
    // Mematikan fungsi timestamp laravel
    public $timestamps = false;

    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'detail_transaksi';

    // Menentukan PK dari database
    protected $primaryKey = 'id';

    // Agar semua data kecuali 'id' dapat dimasukkan secara serentak oleh user
    protected $guarded = [
        'id'
    ];

    // Relasi dari tabel detail_transaksi ke transaksi
    public function transaksi() {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // Relasi tabel antara detail_transaksi dengan buku
    public function buku() {
        return $this->hasMany(Buku::class, 'id_buku');
    }

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'id';
    }
}
