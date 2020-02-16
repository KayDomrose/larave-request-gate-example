<?php

namespace App\Providers;

use App\User;
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

        /**
         * Define new gate for action 'user.read'.
         */
        Gate::define('user.read', function(User $currentUser, User $targetUser):bool {
            /**
             * Check whether $currentUser is allowed to do 'user.read' on $targetUser.
             * Must return true (is allowed) or false.
             */
            return $currentUser->getAttribute('id') === $targetUser->getAttribute('id');
        });
    }
}
