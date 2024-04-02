<?php

namespace Database\Seeders;

use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAddress = [
            [
                "user_id" => 1,
                "address" => "Banani, Dhaka, 1230",
                "country" => 'Bangladesh',
                "state"   => "Dhaka",
            ],
            [
                "user_id" => 1,
                "address" => "Gulshan, Dhaka, 1230",
                "country" => 'Bangladesh',
                "state"   => "Dhaka",
            ],
            [
                "user_id" => 1,
                "address" => "Niketon, Dhaka, 1230",
                "country" => 'Bangladesh',
                "state"   => "Dhaka",
            ],
            [
                "user_id" => 2,
                "address" => "Tigerpass, Chittagong, 1390",
                "country" => 'Bangladesh',
                "state"   => "Chittagong",
            ],
            [
                "user_id" => 2,
                "address" => "New Market, Chittagong, 1390",
                "country" => 'Bangladesh',
                "state"   => "Chittagong",
            ],
            [
                "user_id" => 3,
                "address" => "Bosurhat, Sylhet, 1190",
                "country" => 'Bangladesh',
                "state"   => "Sylhet",
            ],
            [
                "user_id" => 4,
                "address" => "Majar Road, Khulna, 1590",
                "country" => 'Bangladesh',
                "state"   => "Khulna",
            ],
        ];

        foreach($userAddress as $address){
            UserAddress::create($address);
        }
    }
}
