<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgUser extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
