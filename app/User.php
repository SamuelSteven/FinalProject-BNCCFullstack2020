<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'photo', 'email', 'password',
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function users() {
        return $this->hasMany('App\question', 'userId', 'id');
    }
    public function user() {
        return $this->hasMany('App\answer', 'userId', 'id');
    }
    public function user_reply() {
        return $this->hasMany('App\reply', 'userId', 'id');
    }
}
