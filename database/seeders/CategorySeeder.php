<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    //php artisan db:seed --class=CategorySeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            [
                'id' => 1,
                'title' => "Food",
                "description" => "I am hangry"
            ],

            [
                'id' => 2,
                'title' => "Clothes",
                "description" => "I am naked"
            ],

            [
                'id' => 3,
                'title' => "Sick",
                "description" => "I am m2nta7"
            ],

            [
                'id' => 4,
                'title' => "Sadaka",
                "description" => "For the sake of Allah"
            ],
        ];

        foreach ($cats as $key => $value) {
            Category::create($value);
        }
    }
}
