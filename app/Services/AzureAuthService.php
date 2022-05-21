<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;

class AzureAuthService
{
    private $user;

    private $roleRepository;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param UserRepository $repository
     * @param RoleRepository $roleRepository
     */
    public function __construct( UserRepository $repository, RoleRepository $roleRepository )
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }// __construct

    public function execute()
    {
        return Socialite::driver( 'azure' )->redirect();
    }

    /**
     *
     */
    public function authenticate()
    {
        $user = Socialite::driver( 'azure' )->user();
        option( [ 'azure.token' => $user->token ] );
        $this->syncUser( $user );
        Auth::login( $this->user, true );
        return redirect()->route( 'dashboard' );
    }// authenticate

    /**
     * @param User $user
     */
    private function syncUser( User $user )
    {
        $this->user = $this->repository->findOneBy( [ 'email' => $user->getEmail() ] );
        if( empty( $this->user->email ) ) {
            $this->user = $this->repository->create( [
                'name'               => $user->getNickname() ?? $user->getName(),
                'email'              => $user->getEmail(),
                'profile_photo_path' => $user->getAvatar(),
                'azure_id'           => $user->getId(),
                'office_location'    => $user->user[ 'officeLocation' ],
            ] );
            $role = $this->syncRole( $user );
            $this->user->roles()->sync( $role );
        }
        /* --------------------------------------------------------------
         *  If already logged-in user but is restricted
         * --------------------------------------------------------------
         */
        if( $this->isRestrictedDomain( $user->getEmail() ) ) {
            $role = $this->roleRepository->findByLabel( option( 'azure.fallback.role' ) );
            $this->user->roles()->sync( $role );
        }
    }// syncUser

    /**
     * @param User $user
     *
     * @return mixed
     */
    private function syncRole( User $user )
    {
        /* --------------------------------------------------------------
         *  Check for restricted domain
         * --------------------------------------------------------------
         */
        if( $this->isRestrictedDomain( $user->getEmail() ) ) {
            return $this->roleRepository->findByLabel( option( 'azure.fallback.role' ) );
        }
        $user_info = $user->user;
        // get user Title
        $title = $user_info[ 'jobTitle' ];
        // get Roles Map
        $map = config( 'permissions.roles_map' );
        // get the Mapped Role Label or the Title
        $role_label = $map[ $title ] ?? $title;
        $the_role = $this->roleRepository->findByLabel( $role_label );
        if( empty( $the_role->label ) ) {
            $the_role = $this->roleRepository->create( [ 'label' => $role_label ] );
        }
        return $the_role;
    }

    /**
     * @return bool
     */
    private function isRestrictedDomain( $email )
    {
        $domain = option( 'azure.restricted.domain' );
        if( empty( $domain ) ) {
            return false;
        }

        $domain_from_email = substr( $email, strrpos( $email, '@' ) + 1 );
        return $domain !== $domain_from_email;
    }

}