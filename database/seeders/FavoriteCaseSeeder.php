<?php

namespace Database\Seeders;

use App\Models\FavouriteCase;
use Illuminate\Database\Seeder;

class FavoriteCaseSeeder extends Seeder
{

    //To insert seeds in DB: php artisan db:seed --class=FavoriteCaseSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [
            [
                'id' => 1,
                'user_id' => 1,
                "case_id" => 1,
            ],
            [
                'id' => 2,
                'user_id' => 3,
                "case_id" => 1,
            ],
            [
                'id' => 3,
                'user_id' => 1,
                "case_id" => 2,
            ],
        ];

        foreach ($favorites as $key => $value) {
            FavouriteCase::create($value);
        }
    }
}
