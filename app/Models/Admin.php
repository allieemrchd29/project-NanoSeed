<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','profile_photo',];
    protected $table = 'admins';
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed',];
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : asset('images/default-avatar.png');
    }
}
