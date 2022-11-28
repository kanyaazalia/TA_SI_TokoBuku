<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoSeluruhTransaksi extends Model
{
    use HasFactory;

    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'info_seluruh_transaksi';

    // Menentukan PK dari database
    protected $primaryKey = 'id_transaksi';

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'id_transaksi';
    }
}
