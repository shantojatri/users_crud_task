<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\GlobalConstant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
      /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name"     => "Admin",
                "email"    => "admin@gmail.com",
                "password" => Hash::make('12345678'),
                "phone"    => "01777123121",
                "status"   => GlobalConstant::STATUS_ACTIVE,
            ],
            [
                "name"     => "Pavel",
                "email"    => "pavel@gmail.com",
                "password" => Hash::make('12345678'),
                "phone"    => "01777123122",
                "status"   => GlobalConstant::STATUS_ACTIVE,
            ],
            [
                "name"     => "Shorif",
                "email"    => "shorif@gmail.com",
                "password" => Hash::make('12345678'),
                "phone"    => "01777123123",
                "status"   => GlobalConstant::STATUS_ACTIVE,
            ],
            [
                "name"     => "Amin",
                "email"    => "amin@gmail.com",
                "password" => Hash::make('12345678'),
                "phone"    => "01777123124",
                "status"   => GlobalConstant::STATUS_ACTIVE,
            ],
        ];


        foreach($users as $user){
            User::create($user);
        }
    }
}
