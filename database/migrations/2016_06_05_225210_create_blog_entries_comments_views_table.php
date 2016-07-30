<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesCommentsViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW blog_entries_comments_views AS
                        SELECT 
                              blog_entries_id, COUNT(blog_entries_id) AS countComments
                          FROM
                              blog_entries_comments
                          GROUP BY blog_entries_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_entries_comments_views');
    }
}
