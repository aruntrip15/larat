<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        
                // create permissions
                Permission::create(['name' => 'add user']);
                Permission::create(['name' => 'edit user']);
                Permission::create(['name' => 'delete user']);
        
                $role = Role::create(['name' => 'admin']);
                $role->givePermissionTo('add user');
                $role->givePermissionTo('edit user');
                $role->givePermissionTo('delete user');
    }
}