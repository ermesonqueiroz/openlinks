<?php

namespace App\Actions;

use App\Models\Link;
use App\Models\User;

class CreateLink
{
    public function execute(User $user, array $attributes): Link
    {
        return $user->links()->create($attributes);
    }
}
