<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function subscriptions()
    {
        return $this->hasMany(OrgSubscription::class, 'org_id');
    }

    public function users()
    {
        return $this->hasMany(OrgUser::class, 'org_id');
    }
}
