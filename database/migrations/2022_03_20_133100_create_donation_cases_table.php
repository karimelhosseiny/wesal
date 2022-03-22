<?php

use App\Models\Category;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDonationCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('goal_amount');
            $table->integer('raised_amount');
            $table->string('image');
            $table->dateTime('deadline');
            $table->text('description');
            $table->foreignidfor(Organization::class);
            $table->foreignidfor(Category::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_cases');
    }
}
