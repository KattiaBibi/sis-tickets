<?php

namespace App\Http\Controllers;

use App\Requerimiento;
use App\DetalleRequerimiento;
use App\RequerimientoEncargados;
use App\Servicio;
use App\Empresa;
use App\Colaborador;
use App\EmpresaServicio;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequerimientoRequest;
use App\Http\Requests\RequerimientoActualizarRequest;
use App\subirimagen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class RequerimientoController extends Controller
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


    public function requerimiento()
    {
        $role_name = DB::table('model_has_roles')
            ->select('roles.name AS role_name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_id', '=', auth()->user()->id)
            ->get()->first()->role_name;

        $estado = request()->all()['filters']['estado'] ?? 'todos';

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
                "requerimientos.created_at AS fecha_creacion",
                "requerimientos.imagen AS imagen"
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

        if ($estado != 'todos') {
            $query->where('requerimientos.estado', '=', $estado);
        }

        $rpta = $query->orderBy('requerimientos.created_at', 'desc')->get();

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

        // dd($requerimientos);

        return datatables()->of($requerimientos)->toJson();
    }



    public function getdetalle($id)
    {

        $query = DB::table('detalle_requerimientos')
            ->select("usuario_colab_id as id")
            ->where("requerimiento_id", "=", $id)->get();

        return response()->json($query);
    }



    public function listarservicios($id)
    {


        $empresa_servicios = DB::table('empresa_servicios as es')
            ->join('empresas as e', 'es.empresa_id', '=', 'e.id')
            ->join('servicios as s', 'es.servicio_id', '=', 's.id')
            ->select('es.id as esid', 'e.id as eid', 's.id as sid', 's.nombre as snombre', 'e.nombre as enombre', 's.nombre as snombre')->where('empresa_id', $id)->where("s.estado","=",1)->get();


        return $empresa_servicios;
    }



    public function listargerentes($id)
    {

        // listar gerentes por el área de gerencia

        $gerentes = DB::table('users as u')
            ->join('colaboradores as c', 'u.colaborador_id', '=', 'c.id')
            ->join('empresa_areas as ea', 'c.empresa_area_id', '=', 'ea.id')
            ->select('u.id', 'u.name', 'u.colaborador_id', 'c.nombres', 'c.apellidos')->where('ea.area_id', 1)->where('ea.empresa_id', $id)->where("c.estado","=", 1)->get();

        return $gerentes;
    }


    public function listarcolaboradores($id)
    {

        $colaboradores = DB::table('users as u')
            ->join('colaboradores as c', 'u.colaborador_id', '=', 'c.id')
            ->join('empresa_areas as ea', 'c.empresa_area_id', '=', 'ea.id')
            ->select('u.id', 'u.name', 'u.colaborador_id', 'c.nombres', 'c.apellidos')->where('ea.empresa_id', $id)->where("c.estado","=",1)->get();

        return $colaboradores;
    }



    public function index()

    {

        $servicios = Servicio::all();
        $empresas = DB::table('empresas')->where('estado','=', '1')->get();
        $usuarios = DB::table('users as u')
            ->join('colaboradores as c', 'u.colaborador_id', '=', 'c.id')
            ->select('u.id as usuario_id', 'c.id as colaborador_id', 'c.nombres', 'c.apellidos')->get();

        return view('requerimiento.index', compact('servicios', 'empresas', 'usuarios'));
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
    public function store(RequerimientoRequest $request)
    {

        $ruta = "requerimiento/";
        $file = $request->imagenpost;
        $nombre = "requerimiento";
        $subir = subirimagen::imagen($file, $nombre, $ruta);


        $request->request->add(['imagen' => $subir]);
        $request->request->add(['avance' => 0]);
        $request->request->add(['estado' => 'pendiente']);

        $requerimiento =  Requerimiento::create($request->all());

        $encarg = $request->usuarioencarg_id;
        foreach ($encarg as $key => $value) {
            # code...
            $encargado_requerimiento = RequerimientoEncargados::create([
                "requerimiento_id" => $requerimiento->id,
                "usuarioencarg_id" => $value


            ]);
        }
        return $requerimiento ? 1 : 0;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $registro = Requerimiento::findOrfail($id);


        $servicios = Servicio::all();
        $colaboradores = Colaborador::all();



        $users = DB::table('users as u')
            ->join('colaboradores as c', 'u.colaborador_id', '=', 'c.id')
            ->select('u.id as id', 'c.nombres as nombres', 'c.apellidos as apellidos')->get();


        return view('requerimiento.atencion', compact('servicios', 'estados', 'users', 'registro', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Requerimiento $requerimiento)
    {
        //



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)

    {

        DB::table('detalle_requerimientos')->where('requerimiento_id', $id)->delete();

        $requerimiento = Requerimiento::findOrfail($id);

    //  RUTA DE LA IMAGEN
        $ruta = "requerimiento/";

    // IMAGEN NUEVA
        $file = $request->imagennue;

    // IMAGEN ANTERIOR

        $file2= $request->imganterior;

    // NOMBRE PARA CONCATENAR A LA NUEVA IMAGEN
        $nombre = "requerimiento";

        // return response()->json($file2);


        if($file){

        // SI EXISTE LA IMAGEN NUEVA

            // PRIMERO ELIMINA LA IMAGEN ANTERIOR

            Storage::disk('public')->delete($ruta.$file2);

            // LUEGO SUBE LA IMAGEN A LA CARPETA  STORAGE
            $subir = subirimagen::imagen($file, $nombre, $ruta);

            // DESPUÉS GUARDA EN LA BASE DE DATOS

            $requerimiento->update(
                [
                    'avance' => $request->avance,
                    'prioridad' => $request->prioridad,
                    'estado' => $request->estado,
                    'imagen'=> $subir,
                ]
            );

        }

        else{

            // SI NO MANDA IMAGEN NUEVA

            $requerimiento->update(
                [
                    'avance' => $request->avance,
                    'prioridad' => $request->prioridad,
                    'estado' => $request->estado,
                ]
            );

        }


        if ($request->estado == "en proceso" || $request->estado == "culminado") {

            $colab = $request->usuario_colab_id;
            foreach ($colab as $key => $value) {
                # code...
                $deta_requerimiento = DetalleRequerimiento::create([
                    "usuario_colab_id" => $value,
                    "requerimiento_id" => $requerimiento->id
                ]);
            }


        }


            return $requerimiento ? 1 : 0;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */


    public function destroy(Request $request, $id)
    {
        //delete
        $requerimiento = Requerimiento::findOrfail($id);

        $requerimiento->estado = "cancelado";


        $requerimiento->update();

        return $requerimiento ? 1 : 0;
    }
}
