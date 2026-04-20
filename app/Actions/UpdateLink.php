<?php

namespace App\Actions;

use App\Models\Link;

class UpdateLink
{
    public function execute(Link $link, array $attributes): bool
    {
        return $link->update($attributes);
    }
}
