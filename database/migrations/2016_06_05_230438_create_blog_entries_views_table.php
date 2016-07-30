<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               DB::statement("CREATE VIEW blog_entries_views AS

                        SELECT 
                          entry.id,
                          entry.header,
                          entry.headerUrl,
                          entry.author,
                          entry.state,
                          entry.shortContent,
                          entry.content,
                          config.name AS 'stateName',
                          ifnull(comments.countComments, 0) as countComments,
                          tags.tags,
                          entry.created_at
                      FROM
                          blog_entries entry
                              INNER JOIN
                          configurations config ON entry.state = config.id
                              LEFT JOIN
                                blog_entries_comments_views comments ON comments.blog_entries_id = entry.id
                              LEFT JOIN
                          blog_entries_tags_views tags ON tags.blog_entries_id = entry.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_entries_views');
    }
}
