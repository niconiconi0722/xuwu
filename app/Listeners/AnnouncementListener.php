<?php

namespace App\Listeners;

use App\Events\AnnouncementEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth;
use App\Models\User;
use Notification;
use App\Notifications\Announce;

class AnnouncementListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AnnouncementEvent  $event
     * @return void
     */
    public function handle(AnnouncementEvent $event)
    {
        $users = User::where('id', '<>', Auth::id())->get();
        Notification::send($users, new Announce($event->announcement));
    }
}
