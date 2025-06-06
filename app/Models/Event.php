<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'occurs_at',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(EventUser::class, 'user_id');
    }
}
