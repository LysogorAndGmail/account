<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
        'ip',
        'password',
        'remember_token',
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function orgs()
    {
        return $this->hasMany(OrgUser::class, 'user_id');
    }
}
