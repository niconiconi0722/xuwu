<?php

namespace App\Listeners;

use App\Events\AtUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\User;
use App\Notifications\AtUser;

class AtUserListener implements ShouldQueue
{
    public function handle(AtUserEvent $event)
    {
        $this->atUser($event);
    }

    protected function atUser($event)
    {
        $at_users = $this->getAtUser($event->model->{$event->textColumn});
        if ($at_users) {
            $this->updateText($event->model, $event->textColumn);

            $at_users = array_unique($at_users);
            $this->notifyUsers($at_users, $event->model);
        }
    }

    protected function getAtUser(string $text)
    {
        preg_match_all(
            '/(?<=@)[a-zA-Z0-9\-_]+(?=\s)|(?<=@)[a-zA-Z0-9\-_]+$/',
            $text,
            $at_users
        );

        if (empty($at_users[0])) {
            return false;
        }
        return $at_users;
    }

    protected function updateText($model, $textColumn)
    {
        $newText = $this->markAt($model->{$textColumn});
        $model->update([$textColumn => $newText]);
    }

    protected function markAt(string $beforeReplace)
    {
        $afterReplace = preg_replace(
            '/@[a-zA-Z0-9\-_]+\s|@[a-zA-Z0-9\-_]+$/',
            '<span class="at">$0</span>',
            $beforeReplace
        );
        return $afterReplace;
    }

    protected function notifyUsers(array $users, $notification)
    {
        foreach ($users as $user) {
            $user = User::where('username', $user)->first();
            if ($user) {
                $user->notify(new AtUser($notification));
            }
        }
    }
}
