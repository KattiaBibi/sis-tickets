<?php

namespace App\Http\Controllers;

use App\User;
use App\Colaborador;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserActualizarRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\subirimagen;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usuario(){


        $usuarios=DB::table('users as u')
        ->join('colaboradores as c','u.colaborador_id','=','c.id')
        ->join('model_has_roles as mr','u.id','=','mr.model_id')
        ->join('roles as r','mr.role_id','=','r.id')
        ->select('u.id as uid','u.name as uname','u.email as uemail','u.password as upassword', 'u.estado as uestado', 'u.colaborador_id as ucolaborador_id', 'c.nombres as cnombres', 'u.imagen as imagen','mr.role_id as role_id')->get();


        return datatables()->of($usuarios)->toJson();

     }


     public function getRoll($id){

        $user=User::findOrfail($id)->getRoleNames();
        return $user;
     }

    public function index()
    {
        //


        $colaboradores= Colaborador::all();
        $roles= Role::all();

        return view('usuario.index', compact('colaboradores','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)

    {

        $ruta = "foto/";
        $file = $request->imagenpost;
        $nombre = "foto";
        $subir = subirimagen::imagen($file, $nombre, $ruta);


        $usuario=User::create(
        ['name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'colaborador_id' => $request->colaborador_id,
        'imagen'=> $subir
        ]
        )->assignRole($request->role);

        return $usuario?1:0;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $empresa_areas = DB::table('empresa_areas as ea')
        ->join('empresas as e', 'ea.empresa_id', '=', 'e.id')
        ->join('areas as a', 'ea.area_id', '=', 'a.id')
        ->select('ea.id as eaid', 'e.id as eid', 'a.id as aid', 'e.nombre as enombre', 'a.nombre as anombre')->get();

        $usuario=DB::table('users as u')
        ->join('colaboradores as c','u.colaborador_id','=','c.id')
        ->join('empresa_areas as ea','c.empresa_area_id','=','ea.id')
        ->join('model_has_roles as mr','u.id','=','mr.model_id')
        ->join('roles as r','mr.role_id','=','r.id')
        ->select('u.id as uid','u.name as uname','u.email as uemail','u.password as upassword', 'u.estado as uestado', 'u.colaborador_id as ucolaborador_id', 'c.nrodocumento as nrodoc','nombres as cnombres','c.apellidos as capellidos','c.fechanacimiento as fechanac','c.direccion as direccion','c.telefono as tf', 'u.imagen as imagen','mr.role_id as role_id', 'c.empresa_area_id as empresa_area_id')
        ->where('u.id', auth()->user()->id)
        ->first();

        $roles= Role::all();
        return view('usuario.perfil', compact('usuario', 'empresa_areas','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserActualizarRequest $request, $id)
    {
        // dd($request);

        $usuario=User::findOrfail($id);

        $ruta = "foto/";
        $file = $request->imagennue;
        $file2= $request->imganterior;
        $nombre = "foto";

        $valor=$usuario->password; // VALOR DE LA CONSULTA
        $valo2=$request->password; // VALOR DE FORMULARIO

        // SI EL VALOR DEL FORMULARIO PARA EDITAR LA CONTRASEÑA ES NULA, SE PONE EN LA VARIABLE $PASS EL VALOR DE LA CONTRASEÑA GUARDADA EN LA BASE DE DATOS
        if($valo2=='null'){

            $pass= $valor;

        };

        // SI EL VALOR DEL FORMULARIO PARA EDITAR LA CONTRASEÑA NO ES NULA, SE PONE EN LA VARIABLE $PASS EL VALOR DEL FORMULARIO CON LA NUEVA CONTRASEÑA LA CUAL CON HASG SE LOGRA ENCRIPTAR

        if($valo2 != 'null'){

            $pass=Hash::make($valo2);
        };

    if($file){

        Storage::disk('public')->delete($ruta.$file2);

        // LUEGO SUBE LA IMAGEN A LA CARPETA  STORAGE
        $subir = subirimagen::imagen($file, $nombre, $ruta);

        // DESPUÉS GUARDA EN LA BASE DE DATOS


            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $pass,
                'colaborador_id' => $request->colaborador_id,
                'imagen' => $subir
                ]
            );

            $usuario->syncRoles($request->role);

    }

    else{

            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $pass,
                'colaborador_id' => $request->colaborador_id
            ]
            );
            $usuario->syncRoles($request->role);

    }


        return $usuario?1:0;

        // $usuario = User::findOrfail($id)->update(['password'=> 'Lorem ipsum']);

        // $usuario = request()->all();
        // $usuario['password'] = bcrypt($usuario['password']);
        // $usuario->update($usuario);

        // return $usuario?1:0;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::findOrfail($id);

        if ($user->estado == 1) {
            $user->estado = 0;
        } else {
            $user->estado = 1;
        }

        $user->update();

        return $user ? 1 : 0;
    }
}
