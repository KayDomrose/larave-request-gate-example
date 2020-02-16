<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\UserController;
use App\Http\Requests\User\UserReadRequest;
use JMac\Testing\Traits\HttpTestAssertions;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    use HttpTestAssertions;
    /**
     * Test that the correct request is used for UserController->read.
     * Using https://github.com/jasonmccreary/laravel-test-assertions
     */
    public function test_controller_calls_correct_request()
    {
        $this->assertActionUsesFormRequest(
            UserController::class,
            'read',
            UserReadRequest::class
        );
    }
}
