<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 *
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'label'       => 'Admin',
                'name'        => 'super-admin',
                'permissions' => [ 'access users', 'add user', 'edit user', 'delete user', 'access roles', 'add role', 'edit role', 'delete role', 'access dashboard', 'edit permissions', ],
            ],
            [
                'label'       => 'Manager',
                'name'        => 'manager',
                'permissions' => [ 'access dashboard' ]
            ],
            [
                'label'       => 'Sales',
                'name'        => 'sales',
                'permissions' => [ 'access dashboard' ]
            ],
            [
                'label'       => 'Customer Service Representative',
                'name'        => 'csr',
                'permissions' => [ 'access dashboard', 'access contracts' ]
            ],
            [
                'label'       => 'Technician',
                'name'        => 'technician',
                'permissions' => [ 'access dashboard', 'access contracts' ]
            ],
            [
                'label'       => 'Regional VP',
                'name'        => 'rvp',
                'permissions' => [ 'access dashboard' ]
            ],
            [
                'label'       => 'Regional Controller',
                'name'        => 'regional-controller',
                'permissions' => [ 'access dashboard', 'access misc deposits', 'create misc deposits' ]
            ],
            [
                'label'       => 'Authenticated',
                'name'        => 'authenticated',
                'permissions' => [ 'access dashboard' ]
            ],
            [
                'label'       => 'Critter Control Admin',
                'name'        => 'cca',
                'permissions' => [ 'access dashboard', 'access contracts', 'add contract', 'edit contract' ]
            ],
        ];

        foreach( $roles as $role ) {
            Role::create( $role );
        }
    }// run

}// RoleSeeder
