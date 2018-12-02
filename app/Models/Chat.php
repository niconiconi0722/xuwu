<?php

namespace App\Models;

class chat extends Model
{
    protected $fillable = ['content'];
    protected $touches = ['room'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
