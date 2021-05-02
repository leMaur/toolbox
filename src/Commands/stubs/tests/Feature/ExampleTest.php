<?php

declare(strict_types=1);

it('ensures homepage is available', function () {
    $this->get('/')->assertSuccessful();
});
