<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'admin_notifications';

    protected $fillable = [
        'nama_donatur',
        'jumlah_donasi',
        'donasi_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'donasi_id');
    }

    /**
     * Scope: hanya yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}