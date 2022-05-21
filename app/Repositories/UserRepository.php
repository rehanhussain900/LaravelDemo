<?php

namespace App\Repositories;

use App\Models\User;

/**
 *
 */
class UserRepository
{
    /**
     * @param $where
     * @param $createFields
     *
     * @return mixed
     */
    public function findOrCreate( $where, $createFields )
    {
        return User::firstOrCreate( $where, $createFields );
    }

    public function findOneBy( $where )
    {
        return User::where( $where )->first();
    }

    public function create( $attributes )
    {
        return User::create( $attributes );
    }

    public function getUserByRole( $roleName )
    {
        return User::whereHas(
            'roles', function($q) use($roleName){
                $q->where('name', $roleName);
            }
        )->get();
    }

}