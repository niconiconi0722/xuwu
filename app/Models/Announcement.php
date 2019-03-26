<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillabe = [
        'title', 'content', 'priorty'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}