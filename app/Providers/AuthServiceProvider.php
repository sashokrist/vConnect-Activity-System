<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
        //hasRole method to check the current user role, method is in User model
        Gate::define('manage-users', function ($user){
            return $user->hasAnyRoles(['admin']);
        });
        Gate::define('admin', function ($user){
            return $user->hasAnyRoles(['admin']);
        });
        Gate::define('update-users', function ($user){
           return $user->hasRole('admin');
        });

        Gate::define('delete-users', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('create-post', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('management-post', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-posts', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('update-posts', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('generate-time-slot', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('poll-result', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('manage-poll', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('new-poll', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('new-massage', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('export', function ($user){
            return $user->hasRole('admin');
        });

        Gate::define('user', function ($user){
            return $user->hasRole('user');
        });

    }
}
