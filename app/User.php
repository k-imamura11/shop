<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //管理画面用バリデータ
    public function validator(array $data){

      return Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'present',
        'address' => 'required|string|max:255',
        'phone_number' => 'present',
        'address_number' => 'present',
        'born' => 'present|numeric',
      ])-> validate();
    }

}
