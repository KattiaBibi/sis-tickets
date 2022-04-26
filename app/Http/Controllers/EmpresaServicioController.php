<?php

namespace App\Http\Controllers;

use App\EmpresaServicio;
use App\Empresa;
use App\Servicio;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaServicioRequest;
use Illuminate\Support\Facades\DB;

class EmpresaServicioController extends Controller
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

    public function empresa_servicio()
    {


        $empresa_servicios = DB::table('empresa_servicios as es')
            ->join('empresas as e', 'es.empresa_id', '=', 'e.id')
            ->join('servicios as s', 'es.servicio_id', '=', 's.id')
            ->select('es.id as esid', 'e.id as eid', 's.id as sid', 'e.nombre as enombre', 's.nombre as snombre');

        return datatables()->of($empresa_servicios)->toJson();
    }


    public function index()
    {
        //
        $empresas = Empresa::all();
        $servicios = Servicio::all();

        return view('empresa_servicio.index', compact('empresas', 'servicios'));
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
    public function store(EmpresaServicioRequest $request)
    {
        //

        $empresa_servicio = EmpresaServicio::create($request->all());

        return $empresa_servicio ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpresaServicio  $empresaServicio
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresaServicio $empresaServicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpresaServicio  $empresaServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpresaServicio $empresaServicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaServicioRequest $request, $id)
    {
        //
        $empresaservicio = EmpresaServicio::findOrfail($id);
        $empresaservicio->update($request->all());

        return $empresaservicio ? 1 : 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpresaServicio  $empresaServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresaServicio $empresaServicio)
    {
        //
    }
}
