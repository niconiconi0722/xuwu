<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AtUserEvent
{
    use SerializesModels;

    public $model;
    public $textColumn;

    public function __construct($model, string $textColumn)
    {
        $this->model = $model;
        $this->textColumn = $textColumn;
    }

    public function broadcastOn()
    {
        return [];
    }
}