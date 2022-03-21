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

        Permission::create(['name'=>'home'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.listado'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.crear'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.editar'])->syncRoles([$role1]);
        Permission::create(['name'=>'empresa.desactivar'])->syncRoles([$role1]);


        Permission::create(['name'=>'area.listado'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.crear'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.editar'])->syncRoles([$role1]);
        Permission::create(['name'=>'area.desactivar'])->syncRoles([$role1]);


    }
}
