<?php

namespace App\Listeners;


use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\User\UserAddressService;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreUserAddress
{
    /**
     * Create the event listener.
     */
    public function __construct(protected UserAddressService $userAddressService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        // Store the user address by userAddressService
        $this->userAddressService->storeUserAddress($event);
    }
}
