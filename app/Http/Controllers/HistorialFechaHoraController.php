<?php

namespace App\Http\Controllers;

use App\HistorialFechaHora;
use Illuminate\Http\Request;
use App\Http\Controllers\DateTime;

class HistorialFechaHoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //    dd($request);

        $historialfechahora =  HistorialFechaHora::create([
        'fechahoraprogramada'=>$request->fechahora,
        'motivo'=>$request->motivo,
        'detalle_requerimiento_id'=>$request->detalle_requerimiento_id]);

        return $historialfechahora ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistorialFechaHora  $historialFechaHora
     * @return \Illuminate\Http\Response
     */
    public function show(HistorialFechaHora $historialFechaHora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistorialFechaHora  $historialFechaHora
     * @return \Illuminate\Http\Response
     */
    public function edit(HistorialFechaHora $historialFechaHora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistorialFechaHora  $historialFechaHora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorialFechaHora $historialFechaHora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistorialFechaHora  $historialFechaHora
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorialFechaHora $historialFechaHora)
    {
        //
    }
}
