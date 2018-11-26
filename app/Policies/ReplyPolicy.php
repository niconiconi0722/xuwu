<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function destroy(User $user, Reply $reply)
    {
        $is_author = $user->isAuthorOf($reply) || $user->isAuthorOf($reply->article);

        return $user->isAdmin() || $is_author;
    }
}
