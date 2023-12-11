<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'id_karyawan',
        'id_pelanggan',
        'tanggal_pesanan',
        'tanggal_selesai',
        'total_harga'
    ];
}
