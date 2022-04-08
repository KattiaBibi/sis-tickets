<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll_Permiso extends Model
{
    //



    protected $table ='role_has_permissions';

    protected $fillable = [

        'permission_id',
        'role_id',

    ];

}
