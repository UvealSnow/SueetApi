<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function answers () {
        return $this->hasMany('App\Answer');
    }

    public function comments () {
        return $this->hasMany('App\Comment');
    }

    public function posts () {
        return $this->hasMany('App\Post');
    }

    public function employee () {
        return $this->hasOne('App\Employee');
    }

    public function folders () {
        return $this->belongsToMany('App\Folder');
    }

    public function organisation () {
        return $this->hasOne('App\Organisation', 'manager_id');
    }

    public function resident () {
        return $this->hasOne('App\Resident');
    }

    public function rooms () {
        return $this->belongsToMany('App\Room');
    }

    public function uploaded_files () {
        return $this->hasMany('App\Document', 'uploader_id');
    }

}
