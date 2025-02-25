<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //gate to return the users permissions list
        Gate::define('has_permissions', function(User $user, $permission) {
            return $user->role
                ? $user->role->permissions()->where('permissions_list', 'LIKE', "%{$permission}%")->exists()
                : false;
        });
        
    }
}
