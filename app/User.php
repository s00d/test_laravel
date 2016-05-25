<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The function save user profile
     * @param $data
     */
    public static function updateProfile($data){
        $user = Auth::user();
        $user->name = $data['name'];
        $user->phone = $data['phone'];
        if (!empty($data->password)) $user->password = bcrypt($data['password']);
        $user->save();
    }
}
