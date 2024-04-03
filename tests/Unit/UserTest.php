<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
// use PHPUnit\Framework\TestCase;
use App\Utils\GlobalConstant;
use App\Services\User\UserService;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Validator;
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
     * Check if created user can see the userlist
     */
    public function test_user_list_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/users');
        $response->assertOk();
    }

    /**
     * Check if user is created successfully
     */
    public function test_check_if_user_is_created_successfully()
    {
        $request = new UserStoreRequest();
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        $payload = [
            'avatar'                => null,
            'name'                  => 'Example User',
            'email'                 => 'example@example.com',
            'phone'                 => '01777112233',
            'status'                =>  GlobalConstant::STATUS_ACTIVE,
            'password'              => '12345678',
            'password_confirmation' => '12345678',
            'address'               => [
                [
                    'address' => 'Dhaka',
                    'country' => 'Bangladesh',
                    'state'   => 'Dhaka'
                ],
                [
                    'address' => 'Banani',
                    'country' => 'Bangladesh',
                    'state'   => 'Dhaka'
                ]
            ],
        ];

        $validator = Validator::make($payload, $request->rules());

        $this->assertTrue($validator->passes());
        $result = $userService->storeData(new UserStoreRequest($validator->validated()), $payload);
        $this->assertTrue(true, $result);
    }

    /**
     * Check if user is created successfully
     */
    public function test_check_if_user_is_updated_successfully()
    {

        $request = new UserStoreRequest();
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        // $payload = [
        //     'avatar'                =>  null,
        //     'name'                  => 'Example User',
        //     'email'                 => 'example@example.com',
        //     'phone'                 => '01777112233',
        //     'status'                =>  GlobalConstant::STATUS_ACTIVE,
        //     'password'              => '12345678',
        //     'password_confirmation' => '12345678',
        // ];

        $payload = [
            'avatar'                => null,
            'name'                  => 'Example User Update',
            'email'                 => 'alex@example.com',
            'phone'                 => '01755324792',
            'status'                => GlobalConstant::STATUS_ACTIVE,
            'password'              => null,
            'password_confirmation' => null,
            'address'               => [
                [
                    'address' => 'Dhaka',
                    'country' => 'Bangladesh',
                    'state'   => 'Dhaka'
                ],
                [
                    'address' => 'Banani',
                    'country' => 'Bangladesh',
                    'state'   => 'Dhaka'
                ],
                [
                    'address' => 'Khulna',
                    'country' => 'Bangladesh',
                    'state'   => 'Khulna'
                ]
            ],
        ];

        $validator = Validator::make($payload, $request->rules());

        $this->assertTrue($validator->passes());
        $result = $userService->updateData(new UserStoreRequest($validator->validated()), $payload, $user);
        $this->assertTrue(true, $result);
    }

    /**
     * Check if user is deleted successfully
     */
    public function test_check_if_user_is_deleted_successfully()
    {
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        $result = $userService->deleteData($user);
        $this->assertTrue(true, $result);
    }

    /**
     * Check if user is restore successfully
     */
    public function test_check_if_user_is_able_to_see_trashed_users()
    {
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory(5)->create();
        $response = $this->post('/login', [
            'email' => $user[0]->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        $userTwo = User::findOrFail($user[2]->id);
        $userService->deleteData($userTwo);
        $response = $this
            ->actingAs($user[0])
            ->get('/users/trashed');

        $response->assertOk();
    }

    /**
     * Check if user is restore successfully
     */
    public function test_check_if_user_is_restore_successfully()
    {
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        $userService->deleteData($user);
        $result = $userService->restoreData($user->id);
        $this->assertTrue(true, $result);
    }

    /**
     * Check if user is force_delete successfully
     */
    public function test_check_if_user_is_force_delete_successfully()
    {
        $userService = $this->app->make(UserService::class);

        // User authentication
        $user = User::factory()->create();
        $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->assertAuthenticated();

        $userService->deleteData($user);
        $result = $userService->forceDeleteData($user->id);
        $this->assertTrue(true, $result);
    }
}
