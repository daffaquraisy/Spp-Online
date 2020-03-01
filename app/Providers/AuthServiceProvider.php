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

        Gate::define('manage-users', function ($user) {
            return count(array_intersect(["ADMIN", "PETUGAS"], json_decode($user->level)));
        });

        Gate::define('manage-classrooms', function ($user) {
            return count(array_intersect(["ADMIN", "PETUGAS"], json_decode($user->level)));
        });

        Gate::define('manage-students', function ($user) {
            return count(array_intersect(["ADMIN", "PETUGAS"], json_decode($user->level)));
        });

        Gate::define('manage-spp', function ($user) {
            return count(array_intersect(["ADMIN", "PETUGAS"], json_decode($user->level)));
        });

        Gate::define('manage-orders', function ($user) {
            return count(array_intersect(["ADMIN", "PETUGAS"], json_decode($user->level)));
        });
    }
}
