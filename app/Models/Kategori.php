<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'kategori';

    // Menentukan PK dari database
    protected $primaryKey = 'id_kategori';

    // Agar semua data kecuali 'id' dapat dimasukkan secara serentak oleh user
    protected $guarded = [
        'id_kategori'
    ];

    // Relasi dari tabel kategori ke buku
    public function buku() {
        return $this->hasMany(Buku::class, 'id_kategori');
    }

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'id_kategori';
    }
}
