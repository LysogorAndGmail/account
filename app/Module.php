<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'trial_lenght',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function subscriptions()
    {
        return $this->hasMany(OrgSubscription::class, 'module_id');
    }
}
