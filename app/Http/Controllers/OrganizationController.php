<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Organization;
use App\OrgUser;
use App\User;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $orgs = [];

        foreach (auth()->user()->orgs->load('org') as $org) {
            $org    = $org->org->load('users.user');
            $orgs[] = [
                'info'       => $org->load('subscriptions.module'),
                'all_users'  => $this->filterOrgUsers($org->users),
                'is_manager' => $this->isUserOrgManager($org->users->where('role', 'manager'))
            ];
        }

        return response()->json($orgs);
    }

    private function filterOrgUsers($orgUsers)
    {
        $managers = [];
        $users    = [];

        foreach ($orgUsers as $orgUser) {
            if ($orgUser->role === 'manager') {
                $managers[] = $orgUser->user->makeHidden(['id', 'email']);
            } elseif ($orgUser->role === 'user') {
                $users[] = $orgUser->user->makeHidden(['id', 'email']);
            }
        }

        return [
            'managers' => $managers,
            'users'    => $users
        ];
    }

    private function isUserOrgManager($orgUsers)
    {
        foreach ($orgUsers as $orgUser) {
            if ($orgUser->user_id === auth()->id()) {
                return true;
            }
        }

        return false;
    }

    public function show(Organization $org)
    {
        return response()->json($org);
    }

    public function store(OrganizationRequest $request)
    {
        $org          = new Organization();
        $org->name    = $request->name;
        $org->address = $request->address;
        $org->phone   = $request->phone;
        $org->email   = $request->email;
        $org->reg     = $request->reg;
        $org->vat     = $request->vat;
        $org->save();

        $orgUser          = new OrgUser();
        $orgUser->org_id  = $org->id;
        $orgUser->user_id = auth()->id();
        $orgUser->role    = 'manager';
        $orgUser->save();

        info("User id=$orgUser->user_id stored a new org id=$org->id");

        return response()->json(['message' => 'Organization Created']);
    }

    public function update(OrganizationRequest $request, Organization $org)
    {
        $org->name    = $request->name;
        $org->address = $request->address;
        $org->phone   = $request->phone;
        $org->email   = $request->email;
        $org->reg     = $request->reg;
        $org->vat     = $request->vat;
        $org->update();

        $authId = auth()->id();
        info("User id=$authId updated an org id=$org->id");

        return response()->json(['message' => 'Organization Updated']);
    }
}
