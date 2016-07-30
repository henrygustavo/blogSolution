<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogEntriesComments extends Model
{
    protected $table = "blog_entries_comments";
    protected $fillable = ['name','email','comment','state','blog_entries_id'];
    
    public function blogEntries()
    {
        return $this->belongsTo('\BlogSolution\BlogEntries');
    }
}
