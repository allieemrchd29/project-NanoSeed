<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'dokumentasi';
    protected $primaryKey = '_id'; 

    protected $fillable = [
        'id_kampanye',
        'keterangan',
        'tanggal_dokumentasi',
    ];

    /**
     * Relasi ke Model Kampanye
     */
    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class, 'id_kampanye', '_id');
    }

    /**
     * Relasi ke Model FotoDokumentasi
     */
    public function fotos()
    {
        return $this->hasMany(FotoDokumentasi::class, 'id_dokumentasi', '_id');
    }
}