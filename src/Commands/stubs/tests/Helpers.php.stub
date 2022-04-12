<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function actingAs(?Authenticatable $user = null): TestCase
{
    if ($user === null) {
        $user = User::factory()->withUuid()->create();
    }

    return test()->actingAs($user);
}

function logout(): void
{
    auth()->logout();
}

/**
 * @throws JsonException
 * @throws InvalidArgumentException
 */
function fixture(string $name): array
{
    $file = file_get_contents(
        filename: base_path("tests/Fixtures/$name.json"),
    );

    if (! $file) {
        throw new InvalidArgumentException(
            message: "Cannot find fixture: [$name] at tests/Fixtures/$name.json",
        );
    }

    return json_decode(
        json: $file,
        associative: true,
        flags: JSON_THROW_ON_ERROR
    );
}
