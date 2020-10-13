<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    //
    protected $table='productos';

    protected $fillable = [
        'name', 'descripcion','cantidad','precio_c_u','precio_doce'
    ];


    protected $primaryKey = 'id_producto';

}
