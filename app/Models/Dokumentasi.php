<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';
    protected $primaryKey = 'id_dokumentasi';

    protected $fillable = [
        'id_kampanye',
        'foto_dokumentasi',
        'keterangan',
        'tanggal_dokumentasi',
    ];

    // Relasi ke Kampanye
    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class, 'id_kampanye', 'id');
    }

    public function fotos()
    {
        return $this->hasMany(FotoDokumentasi::class, 'id_dokumentasi', 'id_dokumentasi');
    }
}
