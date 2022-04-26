<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('isAdmin', function($user){
            return $user->role == 'admin';
        });
        Gate::define('isEleve', function($user){
            return $user->role == 'eleve';
        });
        Gate::define('isResponsable', function($user){
            return $user->role == 'responsable';
        });
        Gate::define('isTuteur', function($user){
            return $user->role == 'tuteur';
        });
        Gate::define('isSecretaire', function($user){
            return $user->role == 'secretaire';
        });
    }
}
