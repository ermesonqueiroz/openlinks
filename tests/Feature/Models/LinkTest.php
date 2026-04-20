<?php

declare(strict_types=1);

use App\Models\Link;

test('to array', function () {
    $link = Link::factory()->create();

    expect($link->toArray())->toHaveKeys([
        'id',
        'alias',
        'title',
        'destination_url',
        'user_id',
        'created_at',
        'updated_at',
    ]);
});
