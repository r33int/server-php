<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profilepic', 'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'updated_at', 'email_verified_at'
    ];

    public function keys() {
        return $this->hasMany('App\Key');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }

    public function teamsCreator()
    {
        return $this->hasMany('App\Team', 'creator_id');
    }

    public function invitations()
    {
        return $this->hasMany('App\TeamInvitation');
    }
}
