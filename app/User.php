<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function isAdmin()
    {
      return ($this->role == 1);
    }

    public function roleToString(){
      $ret = "";
      switch ($this->role) {
        case 0:
          $ret = "Usuario básico";
          break;
        case 1:
          $ret = "Administrador";
          break;
        default:
          $ret = "Sin definir";
          break;
      }
      return $ret;
    }
}
