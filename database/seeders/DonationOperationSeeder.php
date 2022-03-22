<?php

namespace Database\Seeders;

use App\Models\DonationOperation;
use Illuminate\Database\Seeder;

class DonationOperationSeeder extends Seeder
{
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

            
        ];

        foreach ($donationOperations as $key => $value) {
            DonationOperation::create($value);
        }
    }
}

    

