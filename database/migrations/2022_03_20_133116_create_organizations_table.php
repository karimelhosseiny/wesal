<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('verificationdocuments');
            $table->string('phonenumber');
            $table->string('image');
            $table->text('description');
            $table->boolean('verified');
            $table->dateTime('verifiedat');

            $table->unsignedInteger('verifiedby');
            $table->foreign('verifiedby')
                    ->references('id')
                    ->on('admins')
                    ->onDelete('cascade');

            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('organizations');
    }
}
