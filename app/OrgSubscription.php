<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgSubscription extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
