<?php

namespace Database\Seeders;

use App\Models\DonationOperation;
use Illuminate\Database\Seeder;

class DonationOperationSeeder extends Seeder
{
    //To insert seeds in DB: php artisan db:seed --class=DonationOperationSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donationOperations = [
            [
                'id' => 1,
                "amount" => 500,
                "currency"=>"$",
                "stripe_key"=>"hi",
                "case_id" => 1,
                "user_id" => 3
            ],
            [
                'id' => 2,
                "amount" => 100,
                "currency"=>"$",
                "stripe_key"=>"pay",
                "case_id" => 1,
                "user_id" => 3
            ],
            [
                'id' => 3,
                "amount" => 800,
                "currency"=>"$",
                "stripe_key"=>"yes",
                "case_id" => 1,
                "user_id" => 1
            ],
            [
                'id' => 4,
                "amount" => 1000,
                "currency"=>"$",
                "stripe_key"=>"woow",
                "case_id" => 2,
                "user_id" => 1
            ],

            
        ];

        foreach ($donationOperations as $key => $value) {
            DonationOperation::create($value);
        }
    }
}

    

