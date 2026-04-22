<?php

use Tests\TestCase;

pest()->extend(TestCase::class)
    ->in('Feature')
    ->in('Feature', '../resources/views');
