<?php

namespace App\Models;

class Room extends Model
{
    protected $fillable = [
        'name', 'description',// 'max_users', 'master'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('actived_at');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
