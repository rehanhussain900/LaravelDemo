<?php

namespace App\Traits;

trait UserPermissions
{
    protected $permissions = [];

    /**
     *
     */
    public function abilities()
    {
        if( empty( $this->permissions ) ) {
            $roles = $this->roles;
            foreach( $roles as $role ) {
                $this->permissions[] = $role->permissions;
            }
            $this->permissions = array_merge( ...$this->permissions );
        }

        return $this->permissions;
    }// abilities

    /**
     * @param $do
     *
     * @return bool
     */
    public function hasAbilityTo( $do ) : bool
    {
        $permissions = $this->abilities();
        return in_array( $do, $permissions, true );
    }// hasAbilityTo
    
    /**
     * @return bool
     */
    public function isSuperAdmin() : bool
    {
        $super_users = config( 'app.super-users' );
        return in_array( $this->email, $super_users, true );
    }

}// UserPermissions
