<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;
use App\Http\Requests\ServicioRequest;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.servicio.listado')->only('index');
        $this->middleware('can:admin.servicio.crear')->only('store');
        $this->middleware('can:admin.servicio.editar')->only('update');
    }


    public function servicio(Request $request)
    {

        return datatables()->of(Servicio::all())->toJson();
    }

    public function index()
    {
        //

        return view('servicio.index');
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
    public function store(ServicioRequest $request)
    {
        //

        $servicio = Servicio::create($request->all());

        return $servicio ? 1 : 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
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
    public function update(ServicioRequest $request, $id)
    {
        //

        $servicio = Servicio::findOrfail($id);
        $servicio->update($request->all());

        return $servicio ? 1 : 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio = Servicio::findOrfail($id);

        if ($servicio->estado == 1) {
            $servicio->estado = 0;
        } else {
            $servicio->estado = 1;
        }

        $servicio->update();

        return $servicio ? 1 : 0;
    }
}
