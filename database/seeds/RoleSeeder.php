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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'AdminGerente']);
        $role3 = Role::create(['name' => 'Trabajador']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver el tablero'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.reuniones', 'description' => 'Listar reunión'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.agregar', 'description' => 'Crear reunión'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.editar', 'description' => 'Editar reunión'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.eliminar', 'description' => 'Eliminar reunión'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.requerimientos', 'description' => 'Listar requerimiento'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.requerimientos.agregar', 'description' => 'Crear requerimiento'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.requerimientos.editar', 'description' => 'Editar requerimiento'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.requerimientos.desactivar', 'description' => 'Desactivar requerimiento'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.servicio.listado', 'description' => 'Listar servicios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.crear', 'description' => 'Crear servicio'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.editar', 'description' => 'Editar servicio'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.desactivar', 'description' => 'Desactivar servicio'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.colaborador.listado', 'description' => 'Listar colaboradores'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.crear', 'description' => 'Crear colaborador'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.editar', 'description' => 'Editar colaborador'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.desactivar', 'description' => 'Desactivar colaborador'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.empresa.listado', 'description' => 'Listar empresas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.crear', 'description' => 'Crear empresa'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.editar', 'description' => 'Editar empresa'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.desactivar', 'description' => 'Desactivar empresa'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.area.listado', 'description' => 'Listar áreas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.area.crear', 'description' => 'Crear área'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.area.editar', 'description' => 'Editar área'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.area.desactivar', 'description' => 'Desactivar área'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.empresa_area.listado', 'description' => 'Listar empresas con áreas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_area.crear', 'description' => 'Crear empresas con área'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_area.editar', 'description' => 'Editar empresas con área'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_area.desactivar', 'description' => 'Desactivar empresas con área'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.empresa_servicio.listado', 'description' => 'Listar empresas con servicios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.crear', 'description' => 'Crear empresa con servicio'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.editar', 'description' => 'Editar empresa con servicio'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.desactivar', 'description' => 'Desactivar empresa con servicio'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.usuario.listado', 'description' => 'Listar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.crear', 'description' => 'Crear usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.editar', 'description' => 'Editar usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.desactivar', 'description' => 'Desactivar usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.rol.listado', 'description' => 'Listar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.crear', 'description' => 'Crear rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.editar', 'description' => 'Editar rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.desactivar', 'description' => 'Desactivar rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.permiso.listado', 'description' => 'Listar permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.crear', 'description' => 'Crear permiso'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.editar', 'description' => 'Editar permiso'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.desactivar', 'description' => 'Desactivar permiso'])->syncRoles([$role1]);
    }
}
