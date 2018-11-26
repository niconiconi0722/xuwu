<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification as Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Auth;

class User extends Authenticatable
{
    use Notifiable {
        notify as protected laravelNotify;
    }

    protected $rememberTokenName = '';

    protected $fillable = [
        'username', 'password', 'ni_cheng', 'email', 'authority', 'iconpath'
    ];

    protected $hidden = [
        'password'
    ];

    public function notify($instance)
    {
        //当要通知的人是当前用户就不需要通知了
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count', 1);
        $this->laravelNotify($instance);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->laravelNotify(new ResetPasswordNotification($token));
    }

    public function isAdmin()
    {
        return ($this->authority === 1) || ($this->authority === 2);
    }

    public function isSuperAdmin()
    {
        return $this->authority === 2;
    }

    public function isAuthorOf($model)
    {
        return $this->id === $model->user_id;
    }

    public function markAsRead(Notification $notification, bool $delete = false)
    {
        if ($delete) {
            $notification->delete();
        } else {
            $notification->markAsRead();
        }

        if ($this->notification_count > 0) {
            $this->notification_count--;
            $this->save();
        }
    }
}
