<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Mematikan fungsi timestamp laravel
    public $timestamps = false;

    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'buku';

    // Menentukan PK dari database
    protected $primaryKey = 'id_buku';

    // Agar semua data kecuali 'id' dapat dimasukkan secara serentak oleh user
    protected $guarded = [
        'id_buku'
    ];

    // Relasi dari tabel buku ke kategori
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi dari tabel buku ke penulis
    public function penulis() {
        return $this->belongsTo(Penulis::class, 'id_penulis');
    }

    // Relasi dari tabel buku ke penerbit
    public function penerbit() {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    // Relasi tabel antara buku dengan detail_transaksi
    public function detail_transaksi() {
        return $this->hasMany(DetailTransaksi::class, 'id_buku');
    }

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'id_buku';
    }
}
