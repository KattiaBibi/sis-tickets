<?php

namespace App\Http\Controllers;

use App\Requerimiento;
use App\Servicio;
use App\Empresa;
use App\Colaborador;
use App\EmpresaServicio;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequerimientoRequest;
use Illuminate\Support\Facades\DB;

class RequerimientoController extends Controller
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




    public function requerimiento()

    {

        // $requerimientos=DB::table('requerimientos as r')->join('users as u', 't.usuario_id', '=', 'u.id')->select('r.id as rid','r.problema as rproblema','r.detalle as rdetalle','r.usuario_id as tsuarioid','u.name as uname','t.created_at as tcreated_at')
        // ->whereNotExists(function ($query) {
        //     $query->select("a.requerimiento_id")
        //           ->from('atenciones as a')
        //           ->whereRaw('a.requerimiento_id = t.id');
        // });


        $requerimientos=DB::table('requerimientos as r')->
        join('users as u', 'r.usuarioregist_id', '=', 'u.id')->
        join('users as us','r.usuarioencarg_id','=','u.id')->
        join('colaboradores as c','u.colaborador_id','=','c.id')->
        join('colaboradores as co','us.colaborador_id','=','c.id')->
        join('empresa_servicios as es','r.empresa_servicio_id','=','es.id')->
        join('empresas as e','es.empresa_id','=','e.id')->
        join('servicios as s','es.servicio_id','=','s.id')->
        select('r.id as rid','r.titulo','r.descripcion','r.avance','r.prioridad','r.estado as restado','r.created_at as rcreated_at','e.nombre as enombre','s.nombre as snombre','c.nombres as cnombres','co.nombres as conombres');


    return datatables()->of($requerimientos)->toJson();


    }



    public function listarservicios($id){

        $empresa_servicios=DB::table('empresa_servicios as es')
        ->join('empresas as e','es.empresa_id','=','e.id')
        ->join('servicios as s','es.servicio_id','=','s.id')
        ->select('es.id as esid','e.id as eid','s.id as sid','s.nombre as snombre', 'e.nombre as enombre', 's.nombre as snombre')->where('empresa_id',$id)->get();


        return $empresa_servicios;

    }


    public function index()

    {
        //

        $servicios = Servicio::all();
        $empresas = Empresa::all();
        $usuarios = User::all();


        return view('requerimiento.index', compact('servicios','empresas','usuarios'));

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
    public function store(RequerimientoRequest $request)
    {
        //

        $requerimiento =  Requerimiento::create($request->all());

        return $requerimiento?1:0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $registro=Requerimiento::findOrfail($id);


        $servicios = Servicio::all();
        $colaboradores = Colaborador::all();



        $users=DB::table('users as u')
        ->join('colaboradores as c','u.colaborador_id','=','c.id')
        ->select('u.id as id','c.nombres as nombres','c.apellidos as apellidos')->get();


        return view('requerimiento.atencion', compact('servicios','estados','users','registro','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Requerimiento $requerimiento)
    {
        //



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function update(RequerimientoRequest $request, Requerimiento $requerimiento)
    {
        //



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requerimiento $requerimiento)
    {
        //
    }
}
