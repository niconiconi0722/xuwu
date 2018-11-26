<?php

namespace App\Models;

class Article extends Model
{
    protected $fillable = [
        'title', 'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getLinkAttribute()
    {
        return route('articles.show', $this);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'reply':
                $query->reply();
                break;

            default:
                $query->publish();
                break;
        }

        return $query->with('user');
    }

    public function scopeReply($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopePublish($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
