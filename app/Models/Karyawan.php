<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Model
{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Agar nama tabel karyawan yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'karyawan';

    // Menentukan PK dari database
    protected $primaryKey = 'id_karyawan';

    // Agar semua data kecuali 'id' dapat dimasukkan secara serentak oleh user
    protected $guarded = [
        'id_karyawan'
    ];

    // Memberitahu bahwa ada data di tabel ini memiliki parent-child dalam satu tabel
    public function parent() {
        return $this->belongsTo(self::class, 'report_to');
    }

    public function children() {
        return $this->hasMany(self::class);
    }

    // Relasi dari tabel karyawan ke transaksi
    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }

    // Mengatur atribut apa yang akan diambil sebagai kunci rute
    // Default menggunakan id
    public function getRouteKeyName()
    {
        return 'username';
    }
}
