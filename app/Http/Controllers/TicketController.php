<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Servicio;
use App\Prioridad;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
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

    public function ticket(Request $request)
    {


        $tickets = DB::table('tickets as t')
        ->join('users as u', 't.usuario_id', '=', 'u.id')
        ->select('t.id as tid','t.problema as tproblema','t.detalle as tdetalle','t.usuario_id as tsuarioid','u.name as uname','t.created_at as tcreated_at');


        return datatables()->of($tickets)->toJson();



    }


    public function index()
    {
        //

        $servicios = Servicio::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();

        return view('ticket.index', compact('servicios','prioridades','estados'));

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

        $ticket =  Ticket::create($request->all());

        return $ticket?1:0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
