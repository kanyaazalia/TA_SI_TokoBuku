<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Mematikan fungsi timestamp laravel
    public $timestamps = false;

    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'transaksi';

    // Menentukan PK dari database
    protected $primaryKey = 'id_transaksi';

    // Agar semua data kecuali 'id' dapat dimasukkan secara serentak oleh user
    protected $guarded = [
        'id_transaksi'
    ];

    // Relasi dari tabel transaksi ke karyawan
    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi dari tabel transaksi ke detail_transaksi
    public function detail_transaksi() {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'id_transaksi';
    }
}
