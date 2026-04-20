<?php

use App\Actions\CreateLink;
use App\Models\Link;
use App\Models\User;

test('should create a link', function () {
    $user = User::factory()->create();
    $createLink = app(CreateLink::class);

    $link = $createLink->execute($user, [
        'alias' => 'foobar',
        'title' => 'Sample Title',
        'destination_url' => 'https://github.com'
    ]);

    expect(Link::count())->toBe(1)
        ->and($link->alias)->toBe('foobar')
        ->and($link->title)->toBe('Sample Title')
        ->and($link->destination_url)->toBe('https://github.com');
});
