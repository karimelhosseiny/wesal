<?php

namespace Database\Seeders;

use App\Models\Reminder;
use Illuminate\Database\Seeder;

class ReminderSeeder extends Seeder
{
    // php artisan db:seed --class=ReminderSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reminders = [
            [
                'id' => 1,
                'remind_at'=> "2022-03-23 16:01:44",
                'message' =>"remind me please",
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'remind_at'=> "2022-03-23 16:01:44",
                'message' =>"do not remind me please",
                'user_id' => 2,   
            ],
            [
                'id' => 3,
                'remind_at'=> "2022-03-23 16:01:44",
                'message' =>"please remind",
                'user_id' => 1,
            ],
        ];

        foreach ($reminders as $key => $value) {
            Reminder::create($value);
        }
    }
}


