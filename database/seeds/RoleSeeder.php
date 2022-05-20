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
        $role1 = Role::create(['name' => 'Admin', 'estado' => '1']);
        $role2 = Role::create(['name' => 'AdminGerente', 'estado' => '1']);
        $role3 = Role::create(['name' => 'Trabajador', 'estado' => '1']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver el tablero', 'estado' => '1'])->syncRoles([$role1, $role2, $role3]);

        // Permission::create(['name' => 'admin.total_requerimientos', 'description' => 'Ver Total Requerimientos'])->syncRoles([$role1, $role2, $role3]);
        // Permission::create(['name' => 'admin.total_reuniones', 'description' => 'Ver Total Reuniones'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'admin.reuniones', 'description' => 'Listar reunión', 'estado' => '1'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.agregar', 'description' => 'Crear reunión', 'estado' => '1'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.editar', 'description' => 'Editar reunión', 'estado' => '1'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.reuniones.eliminar', 'description' => 'Eliminar reunión', 'estado' => '1'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.requerimientos', 'description' => 'Listar requerimiento', 'estado' => '1'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.requerimientos.agregar', 'description' => 'Crear requerimiento', 'estado' => '1'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.requerimientos.editar', 'description' => 'Editar requerimiento', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.requerimientos.desactivar', 'description' => 'Desactivar requerimiento', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.servicio.listado', 'description' => 'Listar servicios', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.crear', 'description' => 'Crear servicio', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.editar', 'description' => 'Editar servicio', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.servicio.desactivar', 'description' => 'Desactivar servicio', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.colaborador.listado', 'description' => 'Listar colaboradores', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.crear', 'description' => 'Crear colaborador', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.editar', 'description' => 'Editar colaborador', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.colaborador.desactivar', 'description' => 'Desactivar colaborador', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.empresa.listado', 'description' => 'Listar empresas', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.crear', 'description' => 'Crear empresa', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.editar', 'description' => 'Editar empresa', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa.desactivar', 'description' => 'Desactivar empresa', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.empresa_servicio.listado', 'description' => 'Listar empresas con servicios', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.crear', 'description' => 'Crear empresa con servicio', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.editar', 'description' => 'Editar empresa con servicio', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.empresa_servicio.desactivar', 'description' => 'Desactivar empresa con servicio', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.usuario.listado', 'description' => 'Listar usuarios', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.crear', 'description' => 'Crear usuario', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.editar', 'description' => 'Editar usuario', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.usuario.desactivar', 'description' => 'Desactivar usuario', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.rol.listado', 'description' => 'Listar roles', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.crear', 'description' => 'Crear rol', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.editar', 'description' => 'Editar rol', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.rol.desactivar', 'description' => 'Desactivar rol', 'estado' => '1'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.permiso.listado', 'description' => 'Listar permisos', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.crear', 'description' => 'Crear permiso', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.editar', 'description' => 'Editar permiso', 'estado' => '1'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.permiso.desactivar', 'description' => 'Desactivar permiso', 'estado' => '1'])->syncRoles([$role1]);
    }
}
