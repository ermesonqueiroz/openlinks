<?php

declare(strict_types=1);

use App\Models\Visit;

test('to array', function () {
    $link = Visit::factory()->create();

    expect($link->toArray())->toHaveKeys([
        'id',
        'referer_host',
        'referer_url',
        'user_agent',
        'platform',
        'link_id',
        'created_at',
        'updated_at',
    ]);
});
