<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanPerHari extends Model
{
    use HasFactory;
        
    // Agar nama tabel yang digunakan laravel tetap (tidak ditambahkan 's' di belakangnya)
    protected $table = 'pendapatan_per_hari';

    // Menentukan PK dari database
    protected $primaryKey = null;
}
