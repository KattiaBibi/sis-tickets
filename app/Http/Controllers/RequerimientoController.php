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
        $role_name = DB::table('model_has_roles')
            ->select('roles.name AS role_name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_id', '=', auth()->user()->id)
            ->get()->first()->role_name;

        $query = DB::table('requerimientos')
            ->select(
                DB::raw("requerimientos.id AS id"),
                "requerimientos.titulo AS titulo_requerimiento",
                DB::raw("CONCAT(encargado.nombres, ' ', encargado.apellidos) AS nom_ape_encargado"),
                DB::raw("CONCAT(solicitante.nombres, ' ', solicitante.apellidos) AS nom_ape_solicitante"),
                DB::raw("empresas.nombre AS nombre_empresa"),
                DB::raw("servicios.nombre AS nombre_servicio"),
                "requerimientos.avance AS avance_requerimiento",
                "requerimientos.estado AS estado_requerimiento",
                "requerimientos.prioridad AS prioridad_requerimiento",
                "requerimientos.created_at AS fecha_creacion"
            )
            ->join('colaboradores AS encargado', 'encargado.id', '=', 'requerimientos.usuarioencarg_id')
            ->join('colaboradores AS solicitante', 'solicitante.id', '=', 'requerimientos.usuarioregist_id')
            ->join('users', 'users.colaborador_id', '=', 'encargado.id')
            // ->join('users', 'users.colaborador_id', '=', 'solicitante.id')
            ->join('empresa_servicios', 'empresa_servicios.id', '=', 'requerimientos.empresa_servicio_id')
            ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id')
            ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id');
            if ($role_name !== 'Admin') {
                $query->where('users.id', '=', auth()->user()->id);
            }

        $rpta = $query->orderBy('requerimientos.created_at', 'desc')->get();

        return datatables()->of($rpta)->toJson();
    }



    public function listarservicios($id)
    {

        $empresa_servicios = DB::table('empresa_servicios as es')
            ->join('empresas as e', 'es.empresa_id', '=', 'e.id')
            ->join('servicios as s', 'es.servicio_id', '=', 's.id')
            ->select('es.id as esid', 'e.id as eid', 's.id as sid', 's.nombre as snombre', 'e.nombre as enombre', 's.nombre as snombre')->where('empresa_id', $id)->get();


        return $empresa_servicios;
    }


    public function index()

    {
        //

        $servicios = Servicio::all();
        $empresas = Empresa::all();
        $usuarios = User::all();


        return view('requerimiento.index', compact('servicios', 'empresas', 'usuarios'));
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

        $request->request->add(['avance' => 0]);
        $request->request->add(['estado' => 'pendiente']);
        $requerimiento =  Requerimiento::create($request->all());

        return $requerimiento ? 1 : 0;
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
        $registro = Requerimiento::findOrfail($id);


        $servicios = Servicio::all();
        $colaboradores = Colaborador::all();



        $users = DB::table('users as u')
            ->join('colaboradores as c', 'u.colaborador_id', '=', 'c.id')
            ->select('u.id as id', 'c.nombres as nombres', 'c.apellidos as apellidos')->get();


        return view('requerimiento.atencion', compact('servicios', 'estados', 'users', 'registro', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Requerimiento $requerimiento)
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
