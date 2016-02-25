<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends EloquentUser
{
	use Authorizable;

	protected $fillable = ['email', 'password', 'first_name', 'last_name'];

    protected $hidden = ['password', 'remember_token'];

    # Relationship For like Post
    public function likes() {
        return $this->hasMany('App\Like','user_id');
    }

    # Relationship for Resume
    public function resume() {
        return $this->hasOne('App\Resume','user_id');
    }

    # Relationship for Experience
    public function xps() {
        return $this->hasMany('App\Xp','user_id');
    }

    # Relationship for Skills
    public function skills() {
        return $this->hasMany('App\Skill','user_id');
    }

    # Relationship for Languages
    public function langs() {
        return $this->hasMany('App\Lang','user_id');
    }

    # Relationship for Educations
    public function edus() {
        return $this->hasMany('App\Edu','user_id');
    }

    # Relationship for User Comments
    public function comments() {
        return $this->hasMany('App\Comment','from_user_id');
    }

    # Relationship for Profile Comments
    public function profileComments() {
        return $this->hasMany('App\Comment','to_user_id');
    }

    # Relationship for User Rates
    public function rates() {
        return $this->hasMany('App\Rate','from_user_id');
    }

    # Relationship for ProfileRates
    public function profileRates() {
        return $this->hasMany('App\Rate','to_user_id');
    }

    # Retrive full name
    public function fullName() {
        return $this->first_name." ".$this->last_name;
    }

    # delete User
    public function delete()
    {
        if ($this->exists) {
            $this->resume()->delete();
            $this->likes()->delete();
            $this->comments()->delete();
            $this->profileComments()->delete();
            $this->profileRates()->delete();
            $this->rates()->delete();
            $this->xps()->delete();
            $this->edus()->delete();
            $this->skills()->delete();
            $this->langs()->delete();
        }

        parent::delete();
    }
}
