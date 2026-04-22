<?php

use Livewire\Livewire;

test('generates a random alias with 16 chars length', function () {
    Livewire::test('random-alias-button')
        ->call('handleClick')
        ->assertDispatched(
            'random-alias-generated',
            fn ($event, $params) => strlen($params['alias']) === 16
        );
});
