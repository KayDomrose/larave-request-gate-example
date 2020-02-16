<?php

namespace Tests\Unit\Gates;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class UserGateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * === IMPORTANT ===
     * When using artisan to create tests (php artisan make:test --unit),
     * tests extends PHPUnit\Framework\TestCase by default.
     *
     * As we use factories to create test data,
     * we must replace this with Tests\TestCase.
     */
    public function test_allow_reading_user_when_same_id()
    {
        /**
         * As we check for user id, we need to actually store user
         * to db, otherwise there will be no id.
         */
        $currentUser = factory(User::class)->create();

        $result = Gate::forUser($currentUser)->allows('user.read', $currentUser);

        $this->assertTrue($result);
    }

    public function test_dont_allow_reading_user_when_not_same_id()
    {
        $currentUser = factory(User::class)->create();
        $targetUser = factory(User::class)->create();

        $result = Gate::forUser($currentUser)->allows('user.read', $targetUser);

        $this->assertFalse($result);
    }

    public function test_dont_allow_reading_user_for_guest()
    {
        $currentUser = null;
        $targetUser = factory(User::class)->create();

        $result = Gate::forUser($currentUser)->allows('user.read', $targetUser);

        $this->assertFalse($result);
    }
}
