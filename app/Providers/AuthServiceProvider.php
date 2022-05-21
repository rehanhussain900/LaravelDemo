<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before( static function( User $user, $ability ) {
            /* --------------------------------------------------------------
             *  Super User should have all permissions
             * --------------------------------------------------------------
             */
            if( $user->isSuperAdmin() ) {
                return true;
            }

            /* --------------------------------------------------------------
             *  Check User ability
             * --------------------------------------------------------------
             */
            return $user->hasAbilityTo( $ability );
        } );
    }
}
