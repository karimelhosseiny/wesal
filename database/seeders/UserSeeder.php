<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    //To insert seeds in DB: php artisan db:seed --class=UserSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => "Sergi",
                'email' => "sergisamirboules@gmail.com",
                'type' => "admin",
                "image" => "/pp.png",
                'password' => "qwerty",
                "address" => "qwert",
                "phonenumber" => "0122"
            ],
            [
                'id' => 2,
                'name' => "Karim",
                'email' => "karim@gmail.com",
                'type' => "user",
                "image" => "/pp.png",
                'password' => "qwerty",
                "address" => "qwert",
                "phonenumber" => "0122"
            ],
            [
                'id' => 3,
                'name' => "Reda",
                'email' => "reda@gmail.com",
                'type' => "organization",
                "image" => "/pp.png",
                'password' => "qwerty",
                "address" => "qwert",
                "phonenumber" => "0122"
            ],
            [
                'id' => 4,
                'name' => "hesham",
                'email' => "mohamed@gmail.com",
                'type' => "organization",
                "image" => "/pp.png",
                'password' => "qwerty",
                "address" => "qwert",
                "phonenumber" => "0122"
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
            if ($value["type"] == "admin") {
                Admin::create(
                    [
                        "id"=>$value["id"],
                        "access_level"=>"test"
                    ]
                );
            }
        }
    }
}
