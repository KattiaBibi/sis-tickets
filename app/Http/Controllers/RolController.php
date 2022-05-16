<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Roll_Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\RolRequest;



class RolController extends Controller
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


    public function permiso($idrol){

        $permiso= Roll_Permiso::where('role_id',$idrol)->get();

        return $permiso;

    }

    public function rol()
    {

      return datatables()->of(Role::all())->toJson();

    }

    public function index()
    {
        //

        $permissions = DB::table('permissions')->where('estado','=', '1')->get();

        return view('rol.index',compact('permissions'));
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
    public function store(RolRequest $request)
    {
        //

      /*   dd($request->all()); */
        $rol = Role::create(['name'=>$request->name]);


        $rol->permissions()->sync($request->permission);
        return $rol?1:0;


    }

    /**
     *
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */


    public function update(RolRequest $request, Role $rol)
    {
        //put o patach no recuerdo bien , pero todo uso solo get y post :v
        // $rol=Role::findOrfail($id);
        $rol->update(['name'=>$request->name]);

        $rol->permissions()->sync($request->permissions);

        return $rol?1:0;

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $rol = Role::findOrfail($id);

        if ($rol->estado == 1) {
            $rol->estado = 0;
        } else {
            $rol->estado = 1;
        }

        $rol->update();

        return $rol ? 1 : 0;
    }
}
