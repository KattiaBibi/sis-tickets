<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'email', 'password','colaborador_id', 'imagen','estado'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function adminlte_image(){



    $img=auth()->user()->imagen;

    if($img==""){

        return 'https://picsum.photos/300/300';
    }
    else{
        
        return asset('storage/'.$img);

    }

    }


    public function adminlte_desc(){

        $role_name = DB::table('model_has_roles')
        ->select('roles.name AS role_name')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('model_id', '=', auth()->user()->id)
        ->get()->first()->role_name;

        return $role_name;

    }

    public function adminlte_profile_url(){

        return 'profile/username';

    }
}
