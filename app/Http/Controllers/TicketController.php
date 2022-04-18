<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Servicio;
use App\Prioridad;
use App\Estado;
use App\Empresa;
use App\Colaborador;
use App\EmpresaServicio;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
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



    public function ticketasignado()

    {

        $ejemplo=DB::table('atenciones as a')
        ->join('tickets as t','a.ticket_id','=','t.id')
        ->join('estados as e','a.estado_id','=','e.id')
        ->join('users as u','t.usuario_id', '=', 'u.id')
        ->select('a.id as idate','a.descripcion as adescripcion', 't.id as idtic', 'a.created_at as acreated_at','t.problema as tproblema', 't.detalle as tdetalle', 't.usuario_id', 'u.name as uname','e.id as esid', 'e.nombre as estnb');


    return datatables()->of($ejemplo)->toJson();


    }



    public function ticket()

    {

        $tickets=DB::table('tickets as t')->join('users as u', 't.usuario_id', '=', 'u.id')->select('t.id as tid','t.problema as tproblema','t.detalle as tdetalle','t.usuario_id as tsuarioid','u.name as uname','t.created_at as tcreated_at')
        ->whereNotExists(function ($query) {
            $query->select("a.ticket_id")
                  ->from('atenciones as a')
                  ->whereRaw('a.ticket_id = t.id');
        });


    return datatables()->of($tickets)->toJson();


    }

    public function asignado()
    {
        //

        $servicios = Servicio::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();

        return view('ticket.asignado', compact('servicios','prioridades','estados'));
    }


    public function listarservicios($id){

        $empresa_servicios=DB::table('empresa_servicios as es')
        ->join('empresas as e','es.empresa_id','=','e.id')
        ->join('servicios as s','es.servicio_id','=','s.id')
        ->select('es.id as esid','e.id as eid','s.id as sid','s.nombre as snombre', 'e.nombre as enombre', 's.nombre as snombre')->where('empresa_id',$id)->get();


        return $empresa_servicios;

    }

    public function index()

    {
        //

        $servicios = Servicio::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $empresas = Empresa::all();

        return view('ticket.index', compact('servicios','prioridades','estados','empresas'));

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
    public function store(TicketRequest $request)
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
    public function show($id)
    {
        //
        $registro=Ticket::findOrfail($id);


        $servicios = Servicio::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $colaboradores = Colaborador::all();



        $users=DB::table('users as u')
        ->join('colaboradores as c','u.colaborador_id','=','c.id')
        ->select('u.id as id','c.nombres as nombres','c.apellidos as apellidos')->get();


        return view('ticket.atencion', compact('servicios','prioridades','estados','users','registro','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Ticket $ticket)
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
    public function update(TicketRequest $request, Ticket $ticket)
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
