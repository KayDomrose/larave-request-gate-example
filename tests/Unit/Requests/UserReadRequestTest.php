<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\User\UserReadRequest;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Tests\TestCase;

class UserReadRequestTest extends TestCase
{
    /**
     * === IMPORTANT ===
     * When using artisan to create tests (php artisan make:test --unit),
     * tests extends PHPUnit\Framework\TestCase by default.
     *
     * As we use factories to create test data,
     * we must replace this with Tests\TestCase.
     */
    public function test_authorize_calls_gate()
    {
        $request = new UserReadRequest();
        // Set current user
        $request->setUserResolver(function () {
            return factory(User::class)->make([
                'name' => 'currentUserName'
            ]);
        });
        // Set target user with test name
        $request->user = factory(User::class)->make([
            'name' => 'targetUserName',
        ]);

        // Create a mock that checks whether 'allows' is called
        // with action 'user.read'
        // and target user
        $gate = Mockery::mock(GateContract::class);
        $gate
            ->shouldReceive('allows')
            ->with(
                'user.read',
                Mockery::on(function ($user) {
                    return $user->name === 'targetUserName';
                })
            )
            ->once();

        // Check that
        Gate::shouldReceive('forUser')
            ->with(Mockery::on(function ($user) {
                return $user->name === 'currentUserName';
            }))
            ->andReturn($gate)
            ->once();

        $request->authorize();
    }
}
