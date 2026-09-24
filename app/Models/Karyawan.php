<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class Karyawan extends Model
{
    use HasFactory, SoftDeletes; // Tambahkan SoftDeletes di sini

    // Beri tahu Laravel kolom mana yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'jabatan',
        'foto',
        'jenis_kelamin',
        'tanggal_lahir',
        'status'
    ];
}