<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
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

    public function empresa(Request $request)
    {

        // $empresas=Empresa::select('id','nombre', 'direccion', 'telefono','estado_id')->get();

        // return datatables()->of($empresas)->toJson();

      return datatables()->of(Empresa::all())->toJson();

        // $data["data"]=Empresa::select('id',
        // 'nombre',
        // 'direccion',
        // 'telefono',
        // 'estado_id',)->get();

        // return $data;


    }


    public function index()
    {
        //get

        $empresas = Empresa::all();

        return view('empresa.index', compact('empresas','empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get

        return view('empresa.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)

    {

      /*   dd($request->all()); post */
        $empresa = Empresa::create($request->all());

        return $empresa?1:0;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //get
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //get


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaRequest $request, $id)
    {
        //put o patach no recuerdo bien , pero todo uso solo get y post :v
        $empresa=Empresa::findOrfail($id);
        $empresa->update($request->all());

        return $empresa?1:0;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpresaRequest $request, $id)
    {
        //delete
        $empresa=Empresa::findOrfail($id);
        $empresa->estado_id = 2;
        $save();



    }
}
