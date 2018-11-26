<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Auth;

/**
 * 用户被@时的通知
 * 需要在其内容里@用户的模型必须有link属性或者getLinkAttribute方法
 */
class AtUser extends Notification
{
    use Queueable;

    public $model;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return[
            'model_type' => get_class($this->model),
            'model_id' => $this->model->id,
            'do_user_id' => Auth::id(),
        ];
    }
}
