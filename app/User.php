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
     * 
     */

    protected $table='users';

    protected $fillable = [
        'cedula','name', 'lastname','celular','direccion','email', 
    ];

    

    protected $primaryKey = 'cedula';

    protected $keyType = 'string';
    
    public $incrementing = false;

   
}
