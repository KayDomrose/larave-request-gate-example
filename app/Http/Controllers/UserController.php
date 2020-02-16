<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserReadRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Get information for user.
     *
     * @param UserReadRequest $request
     * @param User $user
     * @return User
     */
    public function read(UserReadRequest $request, User $user)
    {
        /**
         * Do stuff with $user without any additional checks.
         *
         * At this point we know for sure that $request->user() is authorized,
         * because of our unit tests: Tests\Unit\Controllers\UserControllerTest.
         *
         * We also know that $user exists due to route model binding.
         * https://laravel.com/docs/master/routing#route-model-binding
         *
         *
         */
        return $user;
    }
}
