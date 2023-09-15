<?php

namespace App\Observers;

use App\Models\User;
use Str;

class UserObserver
{
    public function saving(User $user)
    {
        if (empty($user->uuid)) {
            $user->uuid = (string) Str::uuid();
        }
        
        if (empty($user->unique_id)) {
            $user->unique_id = $user->uniqueId();
        }
    }
}
