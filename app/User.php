<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends \Cartalyst\Sentinel\Users\EloquentUser implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;


    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = \Hash::make($value);
    // }

}