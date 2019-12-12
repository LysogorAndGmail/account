<?php

namespace Tests\Feature;

use App\Organization;
use App\OrgUser;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    protected $org;

    protected function setUp(): void
    {
        parent::setup();
        $this->authenticate();

        $this->org = factory(Organization::class)->create();
    }

    public function testGetUserOrganizations()
    {
        factory(Organization::class, 3)->create();
        $orgs = Organization::all();

        foreach ($orgs as $org) {
            $orgUser          = new OrgUser();
            $orgUser->org_id  = $org->id;
            $orgUser->user_id = Auth::user()->id;
            $orgUser->role    = 'manager';
            $orgUser->save();
        }

        $response = $this->get("api/organization");

        $response->assertOk()
                 ->assertSee('info')
                 ->assertSee('all_users')
                 ->assertSee('is_manager');
    }

    public function testGetOrganizations()
    {
        $response = $this->get("api/organization/{$this->org->id}/show");

        $response->assertOk()
                 ->assertSee('name')
                 ->assertSee('address')
                 ->assertSee('email')
                 ->assertSee('phone')
                 ->assertSee('reg')
                 ->assertSee('vat');
    }

    public function testCreateOrganization()
    {
        $response = $this->post("api/organization/store", [
            'name'    => 'Company LTD',
            'address' => '45 Street, City',
            'phone'   => '98687687',
            'email'   => 'email@email.com',
            'reg'     => '45435435435',
            'vat'     => 'EE2322323'
        ]);

        $response->assertOk()
                 ->assertSee('message');
    }

    public function testUpdateOrganization()
    {
        $response = $this->put("api/organization/{$this->org->id}/update", [
            'name'    => 'New Company LTD',
            'address' => '45 Street, City',
            'phone'   => '98687687',
            'email'   => 'email@email.com',
            'reg'     => '45435435435',
            'vat'     => 'EE2322323'
        ]);

        $response->assertOk()
                 ->assertSee('message');
    }
}
