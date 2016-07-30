<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('siteName',50);
            $table->string('firstName',50);
            $table->string('lastName',50);
            $table->string('email',50);
            $table->string('country',50);
            $table->string('phoneNumber',20);
            $table->string('photoId');
            $table->string('description');
            $table->string('faceBook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('googlePlus')->nullable();
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
        Schema::drop('personal_informations');
    }
}
