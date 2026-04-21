<?php

namespace App\Models;

// Baris di bawah ini yang tadi hilang/kurang:
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'donasis';

    // Membuka izin input data massal
    protected $fillable = [
        'nama_donatur',
        'email_donatur',
        'jumlah_donasi',
        'nomor_telepon',
    ];
}