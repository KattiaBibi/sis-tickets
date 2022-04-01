<?php

namespace App\Http\Controllers;

use App\Atencion;
use App\DetalleAtencion;
use Illuminate\Http\Request;
use App\Http\Requests\AtencionRequest;


class AtencionController extends Controller
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

    public function atencion(Request $request)
    {

      return datatables()->of(Atencion::all())->toJson();

    }

    public function index()
    {
        //


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
    public function store(AtencionRequest $request)
    {
        //aca creas la atencionn
        $idu=Auth()->user()->id;
        $request->request->add(['usuarioadmin_id' => $idu]);
        $atencion = Atencion::create($request->all());
        $colab=$request->usuario_colab_id;
        foreach ($colab as $key => $value) {
            # code...
            $deta_atencion=DetalleAtencion::create([
                "usuario_colab_id"=>$value,
                "atencion_id"=>$atencion->id
            ]);
        }



        return $atencion?1:0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function show(Atencion $atencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function edit(Atencion $atencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atencion $atencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atencion $atencion)
    {
        //
    }
}
