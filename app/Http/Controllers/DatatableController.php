<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class DatatableController extends Controller
{
    //

    public function empresa()
    {

        $empresas=Empresa::select('nombre', 'direccion', 'telefono')->get();

        return datatables()->of($empresas)->toJson();
    }
}
