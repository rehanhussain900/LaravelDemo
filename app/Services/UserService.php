<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct( UserRepository $repository )
    {
        $this->repository = $repository;
    }// __construct

    /**
     * Normalize attributes and create User
     */
    public function create( $attributes )
    {
        if( empty( $attributes[ 'password' ] ) ) {
            unset( $attributes[ 'password' ] );
        } else {
            $attributes[ 'password' ] = Hash::make( $attributes[ 'password' ] );
        }
        return $this->repository->create( $attributes );
    }// create


    /**
     *get users by role 
     */
    public function getUserByRole($role)
    {
       return $this->repository->getUserByRole($role);
    }

}// UserService
