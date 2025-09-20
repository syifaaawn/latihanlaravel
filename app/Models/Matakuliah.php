<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Matakuliah extends Model
{
    use HasFactory;

    // Nama tabel (opsional, default = "matakuliah" -> jamak)
    protected $table = 'matakuliah';

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'matkul',
        'deskripsi'
    ];
}
