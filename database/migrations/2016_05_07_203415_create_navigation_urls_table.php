<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_urls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->string('value',20);
            $table->string('url',50);
            $table->string('icon',20)->nullable();
            $table->smallInteger('order');
            $table->smallInteger('state');
            $table->boolean('isAdmin');
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
        Schema::drop('navigation_urls');
    }
}
