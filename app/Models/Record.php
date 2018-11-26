<?php

namespace App\Models;

class Record extends Model
{
    protected $fillable = [
        'action', 'action_user_id', 'author_user_id', 'content',
    ];
}
