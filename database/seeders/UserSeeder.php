<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Ability;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::whereName( 'super-admin' )->first();
        $managerRole = Role::whereName( 'manager' )->first();

        $users = [
            [
                'email'    => 'super-admin@gmail.com',
                'name'     => 'Super Admin',
                "password" => Hash::make( "admin@123" ),
                'role'     => $adminRole,
            ],
            [
                'email'    => 'abc@gmail.com',
                'name'     => 'Manager',
                "password" => Hash::make( "admin@123" ),
                'role'     => $managerRole,
            ],
        ];

        foreach( $users as $user ) {
            $created = User::firstOrCreate( [
                "email" => $user[ 'email' ],
            ], [
                "name"     => $user[ 'name' ],
                "password" => $user[ 'password' ]
            ] );
            $created->roles()->sync( $user[ 'role' ] );
        }
    }// run

}
