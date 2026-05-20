<?php

namespace App\Models;

// Baris di bawah ini yang tadi hilang/kurang:
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

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
        'order_id',    
        'snap_token',   
        'status',
        'kampanye_id',  // Menambahkan kolom kampanye_id ke fillable
    ];

    protected $casts = [
    'jumlah_donasi' => 'integer',
    ];

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class, 'kampanye_id');
    }
}