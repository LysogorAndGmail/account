<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authenticate()
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);
    }
}
