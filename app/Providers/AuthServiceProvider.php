<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->level == 'Admin';
        });

        Gate::define('isPerawat', function($user){
            if($user->level == 'Perawat'){
                return $user->level == 'Perawat';
            } else if($user->level == 'Admin RM'){
                return $user->level == 'Admin RM';
            } else{
                return $user->level == 'Admin';
            }
        });

        Gate::define('isAdminRm', function($user){
            if($user->level == 'Admin RM'){
                return $user->level == 'Admin RM';
            } else{
                return $user->level == 'Admin';
            }
        });

        Gate::define('isAdminKeuangan', function($user){
            if($user->level == 'Admin Keuangan'){
                return $user->level == 'Aadmin Keuangan';
            } else{
                return $user->level == 'Admin';
            }
        });



        //
    }
}
