<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogEntriesTag extends Model
{
    protected  $table = "blog_entries_tags";
    protected $fillable = ['blog_tags_id','blog_entries_id'];
    
    public function blogEntries()
    {
        return $this->belongsTo('\BlogSolution\BlogEntries','blog_entries_id');
    }
}
