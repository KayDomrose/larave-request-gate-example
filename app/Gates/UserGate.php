<?php


namespace App\Gates;


use App\User;
use Illuminate\Support\Facades\Gate;

class UserGate
{
    public static function register()
    {
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
