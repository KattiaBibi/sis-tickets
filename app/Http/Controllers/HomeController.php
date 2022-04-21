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
                "requerimientos.titulo AS titulo_requerimiento",
                DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape_colaborador"),
                DB::raw("CONCAT(empresas.nombre, ' - ', servicios.nombre) AS descripcion_empresa_servicio"),
                "requerimientos.avance AS avance_requerimiento",
                "requerimientos.estado AS estado_requerimiento",
                "requerimientos.created_at AS fecha_creacion"
            )
            ->join('colaboradores', 'colaboradores.id', '=', 'requerimientos.usuarioencarg_id')
            ->join('users', 'users.colaborador_id', '=', 'colaboradores.id')
            ->join('empresa_servicios', 'empresa_servicios.id', '=', 'requerimientos.empresa_servicio_id')
            ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id')
            ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id');

        if ($role_name !== 'Admin') {
            $query->where('users.id', '=', auth()->user()->id);
        }

        $rpta = $query->orderBy('requerimientos.created_at', 'desc')
            ->limit(4)
            ->get();

        // dd($rpta);

        return datatables()->of($rpta)->toJson();
    }
}
