<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    protected $hidden = ['password', 'remember_token'];
}
