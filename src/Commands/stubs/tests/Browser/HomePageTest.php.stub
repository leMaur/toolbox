<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;

it('ensures home page is visible to everyone', function () {
    Auth::logout();

    $this->browse(function (Browser $browser): void {
        $browser->visit(new HomePage());
    });
});
