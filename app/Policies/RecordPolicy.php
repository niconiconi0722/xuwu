<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Record;

class RecordPolicy extends Policy
{
    public function read(User $user, Record $record)
    {
        return $user->isAdmin();
    }
}
