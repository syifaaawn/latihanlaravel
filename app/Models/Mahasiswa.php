<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel (opsional, default = "mahasiswas" -> jamak)
    protected $table = 'mahasiswa';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama',
        'nim',
        'jurusan'
    ];
}


