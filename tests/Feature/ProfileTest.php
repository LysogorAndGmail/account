<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setup();
        $this->authenticate();
    }

    public function testUpdateProfile()
    {
        $response = $this->put("api/profile/update", [
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john@example.com'
        ]);

        $response->assertOk()
                 ->assertSee('message');
    }

    public function testUpdatePassword()
    {
        $response = $this->put("api/profile/update-password", [
            'password'              => 'Secret',
            'password_confirmation' => 'Secret',
        ]);

        $response->assertOk()
                 ->assertSee('message');
    }
}
