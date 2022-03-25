<?php

namespace App\Http\Controllers;

use App\TipoCita;
use Illuminate\Http\Request;

class TipoCitaController extends Controller
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


    public function tipo(Request $request)
    {

      return datatables()->of(TipoCita::all())->toJson();

    }

    public function index()
    {
        //


        return view('tipo.index');
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


        $tipo= TipoCita::create($request->all());

        return $tipo?1:0;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCita $tipoCita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCita $tipoCita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCita $tipoCita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoCita  $tipoCita
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCita $tipoCita)
    {
        //
    }
}
