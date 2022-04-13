<?php

namespace App\Http\Controllers;

use App\EmpresaArea;
use App\Empresa;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaAreaRequest;
use Illuminate\Support\Facades\DB;

class EmpresaAreaController extends Controller
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

    public function empresa_area()
    {


        $empresa_areas=DB::table('empresa_areas as ea')
        ->join('empresas as e','ea.empresa_id','=','e.id')
        ->join('areas as a','ea.area_id','=','a.id')
        ->select('ea.id as eaid','e.id as eid','a.id as aid', 'e.nombre as enombre', 'a.nombre as anombre');

        return datatables()->of($empresa_areas)->toJson();

    }

    public function index()
    {
        //

        $empresas = Empresa::all();
        $areas = Area::all();

        return view('empresa_area.index', compact('empresas','areas'));
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
    public function store(EmpresaAreaRequest $request)
    {
        //

        $empresa_area = EmpresaArea::create($request->all());

        return $empresa_area?1:0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpresaArea  $empresaArea
     * @return \Illuminate\Http\Response
     */
    public function show(EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpresaArea  $empresaArea
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpresaArea $empresaArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpresaArea  $empresaArea
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaAreaRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpresaArea  $empresaArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresaArea $empresaArea)
    {
        //
    }
}
