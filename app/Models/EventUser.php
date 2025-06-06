<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EventUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'event_users';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id');
    }
}

