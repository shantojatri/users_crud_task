<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;
use App\Utils\GlobalConstant;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Check if user is created successfully
     */
    public function test_check_is_user_stored()
    {
        // $user = User::factory()->create();
        // $this->assertTrue("example@example.com" == $user->email);

        $userService = $this->app->make(UserService::class);

        $payload = [
            'name'              => 'Example User',
            'email'             => 'example@example.com',
            'avatar'            => '/config/default.png',
            'phone'             => '01777112233',
            'status'            => GlobalConstant::STATUS_ACTIVE,
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ];

        $result = $userService->storeData($payload, $payload);

        $this->assertSame($payload['email'], $result->email);
    }
}
