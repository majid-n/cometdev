<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    protected $hidden = ['password', 'remember_token'];
}
