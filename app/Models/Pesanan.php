<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function karyawan(): HasOne
    {
        return $this->hasOne(Karyawan::class, 'id');
    }

    public function pelanggan(): HasOne
    {
        return $this->hasOne(Pelanggan::class, 'id');
    }
}
