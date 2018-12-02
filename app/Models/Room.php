<?php

namespace App\Models;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'max_users', 'host',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function hostUser()
    {
        return $this->belongsTo(User::class, 'host');
    }

    public function isFull()
    {
        return $this->user_count >= $this->max_users;
    }

    public function hasUser($user)
    {
        return $this->users->contains($user);
    }

    public function hostIs($user)
    {
        return $this->host === $user->id;
    }

    public function changeHost($user = null)
    {
        if ($this->is_fixed) {
            return;
        }

        if (! $user) {
            $user = $this->users->random();
        }
        $this->hostUser()->associate($user);
        $this->save();

        return $user;
    }
}
