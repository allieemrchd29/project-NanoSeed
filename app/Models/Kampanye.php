<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Kampanye extends Model
{
    protected $table = 'kampanye';

    protected $fillable = [
        'nama_kampanye',
        'deskripsi',
        'status_kampanye',
        'tanggal_mulai',
        'tanggal_selesai',
        'gambar_kampanye',
    ];

    // Tambahkan relasi ke Donasi
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'kampanye_id', '_id');
    }

    // Tambahkan accessor untuk total terkumpul
    public function getTotalTerkumpulAttribute()
    {
        return $this->donasi()
            ->where('status', 'success')
            ->get()
            ->sum(fn($d) => (int) $d->jumlah_donasi);
    }

    // Tambahkan accessor untuk jumlah pohon terdanai
    public function getPohonTerdanaiAttribute()
    {
        return $this->donasi()
            ->where('status', 'success')
            ->get()
            ->count();
    }

    // Tambahkan accessor untuk jumlah donatur
    public function getDonaturAttribute()
    {
        return $this->donasi()
            ->where('status', 'success')
            ->count();
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'id_kampanye', 'id');
    }
}