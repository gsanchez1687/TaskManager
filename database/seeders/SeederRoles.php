<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeederRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //se crea estos 2 usuarios por defecto
        $role = Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        //se crea un permiso para poder crear tareas
        $permission = Permission::create(['name' => 'admin task']);

        //se le da el rol y el permiso
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

    }
}
