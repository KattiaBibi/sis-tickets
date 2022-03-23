<?php

namespace App\Http\Controllers;

use App\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
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


    public function colaborador(Request $request)
    {
        
        // SELECT c.estado_id,c.id,c.nrodocumento,c.nombres,c.apellidos,c.fechanacimiento,c.direccion,c.telefono,e.nombre,a.nombre FROM colaboradores as c INNER JOIN empresa_areas as ea on c.empresa_area_id=ea.id INNER JOIN empresas as e on ea.empresa_id=e.id INNER JOIN areas as a on ea.area_id=a.id;


        $colaboradores = DB::table('colaboradores as c')
        ->join('empresa_areas as ea', 'c.empresa_area_id', '=', 'ea.id')
        ->join('empresas as e', 'ea.empresa_id', '=', 'e.id')
        ->join('areas as a', 'ea.area_id', '=', 'a.id')
        ->select('c.estado_id','c.id','c.nrodocumento','c.nombres','c.apellidos','c.fechanacimiento','c.direccion','c.telefono','e.nombre','a.nombre')->get();

        return datatables()->of($colaboradores)->toJson();

     }

    public function index()
    {

        return view('colaborador.index');

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
    public function store(Request $request)
    {
        //

        $colaborador =  Colaborador::create($request->all());

        return $colaborador?1:0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function show(Colaborador $colaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function edit(Colaborador $colaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colaborador $colaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colaborador $colaborador)
    {
        //
    }
}
