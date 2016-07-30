<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('blog_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('header');
            $table->string('headerUrl');
            $table->string('author',50);
            $table->mediumText('shortContent');
            $table->text('content');
            $table->smallInteger('state');
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
       Schema::drop('blog_entries');
    }
}
