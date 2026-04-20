<?php

use App\Actions\UpdateLink;
use App\Models\Link;

test('update link', function () {
    $link = Link::factory()->create();
    $updateLink = app(UpdateLink::class);

    $result = $updateLink->execute($link, [
        'alias' => 'updated',
        'title' => 'Updated Link',
        'destination_url' => 'https://updated-link.com'
    ]);

    expect($result)->toBeTruthy()
        ->and($link->alias)->toBe('updated')
        ->and($link->title)->toBe('Updated Link')
        ->and($link->destination_url)->toBe('https://updated-link.com');
});
