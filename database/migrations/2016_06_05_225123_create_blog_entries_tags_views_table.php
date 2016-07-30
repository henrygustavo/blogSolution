<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesTagsViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW blog_entries_tags_views AS
                        SELECT 
                              blog_entries_id,
                                  GROUP_CONCAT(DISTINCT blog_tags.name) AS 'tags'
                          FROM
                              blog_entries_tags
                          INNER JOIN blog_tags ON blog_entries_tags.blog_tags_id = blog_tags.id
                          GROUP BY blog_entries_id");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_entries_tags_views');
    }
}
