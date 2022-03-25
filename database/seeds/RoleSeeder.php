<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'AdminGerente']);
        $role3=Role::create(['name'=>'Trabajador']);

        Permission::create(['name'=>'home','description'=>'Ver el tablero'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.listado','description'=>'Listar empresas'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.crear','description'=>'Crear empresa'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.editar','description'=>'Editar empresa'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.desactivar','description'=>'Desactivar empresa'])->syncRoles([$role1]);


        Permission::create(['name'=>'area.listado','description'=>'Listar áreas'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.crear','description'=>'Crear área'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.editar','description'=>'Editar área'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.desactivar','description'=>'Desactivar área'])->syncRoles([$role1]);


    }
}
