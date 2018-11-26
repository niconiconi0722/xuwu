<?php

namespace App\Models;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'max_users'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
