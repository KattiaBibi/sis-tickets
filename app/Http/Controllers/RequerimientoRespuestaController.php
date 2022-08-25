<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequerimientoRespuestaRequest;
use App\RequerimientoRespuesta;
use App\subirarchivo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequerimientoRespuestaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getByRequerimientoId($id = null)
    {
        $reqRpta = RequerimientoRespuesta::where('requerimiento_id', $id)->first();

        if (!$reqRpta) {
            return response('Resource not found', 404);
        }

        return response()->json($reqRpta, 200);
    }

    public function show($id = null)
    {
        $reqRpta = RequerimientoRespuesta::find($id);

        if (!$reqRpta) {
            return response('Resource not found', 400);
        }

        return response()->json($reqRpta, 200);
    }

    public function store(RequerimientoRespuestaRequest $request)
    {
        $pdf = $request->file('pdf');
        $descripcion = $request->get('descripcion');
        $requerimiento_id = $request->get('requerimiento_id');
        $ruta_recurso = subirarchivo::archivo($pdf, 'pdf', 'requerimiento/');

        $requerimientoRespuesta = RequerimientoRespuesta::create([
            'ruta_recurso' => $ruta_recurso,
            'descripcion' => $descripcion,
            'user_id' => auth()->user()->id,
            'requerimiento_id' => $requerimiento_id,
        ]);

        return response()->json($requerimientoRespuesta);
    }

    public function update(RequerimientoRespuestaRequest $request, $id = null)
    {
        $reqRpta = RequerimientoRespuesta::find($id);

        if (!$reqRpta) {
            return response('Resource not found', 400);
        }

        $pdf = $request->file('pdf');

        $descripcion = $request->get('descripcion');

        if ($pdf) {
            $ruta_recurso = subirarchivo::archivo($pdf, 'pdf', 'requerimiento/', $reqRpta->ruta_recurso);
            $reqRpta->update([
                'ruta_recurso' => $ruta_recurso,
                'descripcion' => $descripcion,
            ]);
        } else {
            $reqRpta->update([
                'descripcion' => $descripcion,
            ]);
        }

        return response()->json($reqRpta);
    }

    public function destroy($id = null)
    {
        $reqRpta = RequerimientoRespuesta::find($id);

        if (!$reqRpta) {
            return response('Resource not found', 400);
        }

        $reqRpta->delete();

        if (file_exists('storage/requerimiento/' . $reqRpta->ruta_recurso)) {
            unlink('storage/requerimiento/' . $reqRpta->ruta_recurso);
        }

        return response()->json($reqRpta);
    }
}
