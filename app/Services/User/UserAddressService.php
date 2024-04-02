<?php

namespace App\Services\User;

use Exception;
use App\Models\UserAddress;

class UserAddressService
{
    /**
     * Construct property promotion
     */
    public function __construct(protected UserAddress $model)
    {
    }


    public function storeUserAddress($event)
    {
        try {
            UserAddress::where('user_id', $event->userAddress['user_id'])->delete();

            foreach ($event->userAddress['address'] as $key => $item) {
                $address = new UserAddress();
                $address->user_id = $event->userAddress['user_id'];
                $address->address = $item['address'];
                $address->country = $item['country'];
                $address->state = $item['state'];
                $address->save();
            }

            return;
        } catch (Exception $e) {
            log_error($e);
        }
    }
}
