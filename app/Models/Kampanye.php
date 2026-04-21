<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'id_kampanye', 'id');
    }
}
