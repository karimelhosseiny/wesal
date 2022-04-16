<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


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

        //degine admin role
        Gate::define('isAdmin', function($admin) {
            return Auth::user()->admin != null;
         });

         //degine organiaztion role
        Gate::define('isOrganization', function($organization) {
            return Auth::user()->organization != null;
         });

          //degine user role
        Gate::define('isUser', function($user) {
            return Auth::check();
         });
    }
}
