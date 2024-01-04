<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon'
    ];
}
