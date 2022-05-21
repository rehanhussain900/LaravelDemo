<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class RoleRepository
{
    private $model;

    /**
     * @param Role $role
     */
    public function __construct( Role $role )
    {
        $this->model = $role;
    }// __construct

    /**
     * @return Role[]|Collection
     */
    public function all()
    {
        return $this->model::all();
    }// all

    /**
     * Get a role by Label
     *
     * @param $label
     *
     * @return mixed
     */
    public function findByLabel( $label )
    {
        return Role::whereLabel( $label )->first();
    }// findByLabel

    /**
     * @param $attributes
     *
     * @return mixed
     */
    public function create( $attributes )
    {
        if( empty( $attributes[ 'permissions' ] ) ) {
            $attributes[ 'permissions' ] = [ 'access dashboard' ];
        }
        return Role::create( $attributes );
    }// create

}// RoleRepository
