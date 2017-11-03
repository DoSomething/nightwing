<?php

namespace Nightwing\Models;

use DoSomething\Gateway\Contracts\NorthstarUserContract;
use DoSomething\Gateway\Laravel\HasNorthstarToken;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements NorthstarUserContract
{
    use HasNorthstarToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'northstar_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
