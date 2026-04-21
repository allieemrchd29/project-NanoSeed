<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoDokumentasi extends Model
{
    protected $table = 'foto_dokumentasi';

    protected $fillable = [
        'id_dokumentasi',
        'foto',
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class, 'id_dokumentasi', 'id_dokumentasi');
    }
}