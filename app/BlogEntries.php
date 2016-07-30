<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogEntries extends Model
{
    protected  $table = "blog_entries";
//    protected $fillable = ['header','headerUrl','author','shortContent','content','created_at','state'];
    
    public function comments()
    {
//        return $this->hasMany('BlogEntryComments');
    }
    
     public function tags()
    {
       return $this->hasMany('\BlogSolution\BlogEntriesTag','blog_entries_id');
    }
}
