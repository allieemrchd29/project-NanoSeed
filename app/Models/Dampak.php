<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Dampak extends Model
{
    protected $fillable = ['judul', 'icon', 'deskripsi'];
}
