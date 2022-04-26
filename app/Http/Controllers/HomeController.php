<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role_name = DB::table('model_has_roles')
            ->select('roles.name AS role_name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_id', '=', auth()->user()->id)
            ->get()->first()->role_name;

        $query = DB::table('requerimientos')->select(DB::raw('COUNT(*) AS total_requerimientos'));
        if ($role_name !== 'Admin') {
            $query = $query->where('usuarioencarg_id', '=', auth()->user()->id);
        }
        $total_requerimientos =  $query->get()->first()->total_requerimientos;

        $total_citas = DB::table('citas')
            ->select(DB::raw('COUNT(*) AS total_citas'))
            ->where('usuario_id', '=', auth()->user()->id)
            ->get()->first()->total_citas;

        $total_colaboradores = DB::table('colaboradores')
            ->select(DB::raw('COUNT(colaboradores.id) AS total_colaboradores'))
            ->join('users', 'users.colaborador_id', '=', 'colaboradores.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', '<>', 'Admin')
            ->get()->first()->total_colaboradores;

        $total_servicios = DB::table('servicios')
            ->select(DB::raw('COUNT(*) AS total_servicios'))
            ->get()->first()->total_servicios;

        // dd($role_name, $total_requerimientos, $total_colaboradores, $total_citas, $total_servicios);

        return view(
            'dashboard',
            compact('total_requerimientos', 'total_colaboradores', 'total_citas', 'total_servicios')
        );
    }

    public function getLastRequerimientos()
    {
        $role_name = DB::table('model_has_roles')
            ->select('roles.name AS role_name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_id', '=', auth()->user()->id)
            ->get()->first()->role_name;

        $query = DB::table('requerimientos')
            ->select(
                DB::raw("requerimientos.id AS id"),
                "requerimientos.titulo AS titulo_requerimiento",
                "requerimientos.descripcion AS descripcion_requerimiento",
                DB::raw("CONCAT(encargado.nombres, ' ', encargado.apellidos) AS nom_ape_encargado"),
                DB::raw("CONCAT(solicitante.nombres, ' ', solicitante.apellidos) AS nom_ape_solicitante"),
                DB::raw("empresas.nombre AS nombre_empresa"),
                DB::raw("empresas.ID AS id_empresa"),
                DB::raw("servicios.nombre AS nombre_servicio"),
                "requerimientos.usuarioregist_id AS usuario_que_registro",
                "requerimientos.avance AS avance_requerimiento",
                "requerimientos.estado AS estado_requerimiento",
                "requerimientos.prioridad AS prioridad_requerimiento",
                "requerimientos.created_at AS fecha_creacion"
            )
            ->join('colaboradores AS encargado', 'encargado.id', '=', 'requerimientos.usuarioencarg_id')
            ->join('colaboradores AS solicitante', 'solicitante.id', '=', 'requerimientos.usuarioregist_id')
            ->join('users AS usuario_encargado', 'usuario_encargado.colaborador_id', '=', 'encargado.id')
            // ->join('users AS usuario_solicitante', 'usuario_solicitante.colaborador_id', '=', 'solicitante.id')
            ->join('empresa_servicios', 'empresa_servicios.id', '=', 'requerimientos.empresa_servicio_id')
            ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id')
            ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id')
            ->join('detalle_requerimientos', 'detalle_requerimientos.requerimiento_id', '=', 'requerimientos.id', 'left');
        if ($role_name !== 'Admin') {
            $query->where('usuario_encargado.id', '=', auth()->user()->id)
                ->orWhere('detalle_requerimientos.usuario_colab_id', '=', auth()->user()->id);
                // ->orWhere('usuario_solicitante.id', '=', auth()->user()->id);
        }

        $rpta = $query->orderBy('requerimientos.created_at', 'desc')->limit(4)->get();

        return datatables()->of($rpta)->toJson();
    }
}
