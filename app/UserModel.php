<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use DB;

class UserModel extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'email','nama','password'
    ];

    public static function register($email,$name,$password)
    {
        return DB::table('tb_user')->insert([
            'email' => $email,
            'name' => $name,
            'password' => $password
        ]);
    } 

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
