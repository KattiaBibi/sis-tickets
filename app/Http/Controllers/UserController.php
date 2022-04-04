<?php

namespace App\Http\Controllers;

use App\User;
use App\Colaborador;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

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

    public function usuario(Request $request){

       //$usuarios = User::all();

        $usuarios=DB::table('users as u')
        ->join('colaboradores as c','u.colaborador_id','=','c.id')
        ->select('u.id as uid','u.name as uname','u.email as uemail','u.password as upassword', 'u.colaborador_id as ucolaborador_id', 'c.nombres as cnombres')->get();

        return datatables()->of($usuarios)->toJson();

     }

    public function index()
    {
        //

        $colaboradores= Colaborador::all();

        return view('usuario.index', compact('colaboradores'));
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
        //

        $usuario =  User::create($request->all());

        return $usuario?1:0;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
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
    public function update(UserRequest $request, $id)
    {
        //

        $usuario=User::findOrfail($id);
        $usuario->update($request->all());



        return $usuario?1:0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
