<?php

namespace App\Listeners;

use DB;
use App\Events\UserCreated;
use App\Models\UserAddress;
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
        $this->userAddressService->storeUserAddress($event);
        // DB::table('user_addresses')->where('user_id', $event->userAddress['user_id'])->delete();

        // foreach ($event->userAddress['address'] as $key => $item) {
        //     $address = new UserAddress();
        //     $address->user_id = $event->userAddress['user_id'];
        //     $address->address = $item['address'];
        //     $address->country = $item['country'];
        //     $address->state = $item['state'];
        //     $address->save();
        // }
    }
}
