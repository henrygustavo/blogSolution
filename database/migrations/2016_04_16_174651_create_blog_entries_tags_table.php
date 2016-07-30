<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entries_tags', function (Blueprint $table) {
            $table->integer('blog_tags_id')->unsigned();
            $table->foreign('blog_tags_id')->references('id')->on('blog_tags');
            $table->integer('blog_entries_id')->unsigned();
            $table->foreign('blog_entries_id')->references('id')->on('blog_entries');
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
        Schema::drop('blog_entries_tags');
    }
}
