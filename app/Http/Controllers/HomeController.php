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

        // $query = DB::table('requerimientos')->select(DB::raw('COUNT(*) AS total_requerimientos'));

        // if ($role_name === 'AdminGerente') {
        //     $query->where('usuarioencarg_id', '=', auth()->user()->id)
        //         ->orWhere('usuarioregist_id', '=', auth()->user()->id);
        // }

        // if ($role_name === 'Trabajador') {
        //     $query->join('detalle_requerimientos', 'detalle_requerimientos.requerimiento_id', '=', 'requerimientos.id', 'left')
        //         ->where('detalle_requerimientos.usuario_colab_id', '=', auth()->user()->id);
        // }

        // $total_requerimientos =  $query->get()->first()->total_requerimientos;

        $total_requerimientos = DB::table('requerimientos')
            ->select(DB::raw('COUNT(requerimientos.id) AS total_requerimientos'))
            ->join('detalle_requerimientos', 'detalle_requerimientos.requerimiento_id', '=', 'requerimientos.id', 'left')
            ->join('requerimiento_encargados', 'requerimiento_encargados.requerimiento_id', '=', 'requerimientos.id', 'left')
            ->where('requerimientos.usuarioregist_id', '=', auth()->user()->id)
            ->orWhere('requerimiento_encargados.usuarioencarg_id', '=', auth()->user()->id)
            ->orWhere('detalle_requerimientos.usuario_colab_id', '=', auth()->user()->id)
            ->get()->first()->total_requerimientos;

        $total_citas = DB::table('citas')
            ->select(DB::raw('COUNT(citas.id) AS total_citas'))
            ->join('detalle_citas', 'detalle_citas.cita_id', '=', 'citas.id', 'left')
            ->where('citas.usuario_id', '=', auth()->user()->id)
            ->orWhere('detalle_citas.usuario_colab_id', '=', auth()->user()->id)
            ->get()->first()->total_citas;

        // if ($role_name === 'Trabajador') {
        //     $query->join('detalle_cita', 'detalle_cita.cita_id', '=', 'citas.id', 'left')
        //         ->where('detalle_cita.usuario_colab_id', '=', auth()->user()->id);
        // }

        $total_colaboradores = DB::table('colaboradores')
            ->select(DB::raw('COUNT(colaboradores.id) AS total_colaboradores'))
            ->join('users', 'users.colaborador_id', '=', 'colaboradores.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', '<>', 'Admin')
            ->get()->first()->total_colaboradores;

        // dd($total_requerimientos, $total_citas);

        return view(
            'dashboard',
            compact('total_requerimientos', 'total_colaboradores', 'total_citas')
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
            ->join('colaboradores AS solicitante', 'solicitante.id', '=', 'requerimientos.usuarioregist_id')
            ->join('users AS usuario_solicitante', 'usuario_solicitante.colaborador_id', '=', 'solicitante.id')
            ->join('empresa_servicios', 'empresa_servicios.id', '=', 'requerimientos.empresa_servicio_id')
            ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id')
            ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id');


        if ($role_name === 'AdminGerente') {
            $query->join('requerimiento_encargados', 'requerimiento_encargados.requerimiento_id', '=', 'requerimientos.id', 'left')
                ->where('requerimiento_encargados.usuarioencarg_id', '=', auth()->user()->id);
        }

        if ($role_name === 'Trabajador') {
            $query->join('detalle_requerimientos', 'detalle_requerimientos.requerimiento_id', '=', 'requerimientos.id', 'left')
                ->where('detalle_requerimientos.usuario_colab_id', '=', auth()->user()->id);
        }

        $rpta = $query->orderBy('requerimientos.created_at', 'desc')->limit(4)->get();

        $requerimientos = $rpta->all();

        foreach ($requerimientos as &$req) {
            $req->asignados = DB::table('detalle_requerimientos')
                ->select(
                    DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape")
                )
                ->join("users", 'users.id', '=', 'detalle_requerimientos.usuario_colab_id', 'inner')
                ->join("colaboradores", 'colaboradores.id', '=', 'users.colaborador_id', 'inner')
                ->where('detalle_requerimientos.requerimiento_id', '=', $req->id)
                ->get()->all();

            $req->encargados = DB::table('requerimiento_encargados')
                ->select(
                    DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape")
                )
                ->join("users", 'users.id', '=', 'requerimiento_encargados.usuarioencarg_id', 'inner')
                ->join("colaboradores", 'colaboradores.id', '=', 'users.colaborador_id', 'inner')
                ->where('requerimiento_encargados.requerimiento_id', '=', $req->id)
                ->get()->all();
        }

        // dd($rpta);

        return datatables()->of($requerimientos)->toJson();
    }
}
