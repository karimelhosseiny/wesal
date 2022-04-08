<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    // php artisan db:seed --class=OrganizationSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orgs = [
            [
                'id' => "1",
                'title' => "Resala",
                "image" => "/pp.png",
                "phonenumber" => "0122",
                "verificationdocuments" => "/doc.pdf",
                "description" => "hello world",
                "verified" => 1,
                "verifiedat" => "2022-03-23 16:07:26",
                "verifiedby" => 1,
                "creator_id" => 3,
            ],
            [
                'id' => "2",
                'title' => "misrelkhier",
                "image" => "/pp.png",
                "phonenumber" => "01233",
                "verificationdocuments" => "/doc.pdf",
                "description" => "please donate",
                "verified" => 1,
                "verifiedat" => "2022-03-23 16:07:26",
                "verifiedby" => 1,
                "creator_id" => 3,
            ],
        ];

        foreach ($orgs as $key => $value) {
            Organization::create($value);
        }
    }
}
