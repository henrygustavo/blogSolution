<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BlogEntriesView extends Model
{
    protected $table = "blog_entries_views";

//    public function getCreatedAtAttribute($date) {
//        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
//    }
//
//    public function getUpdatedAtAttribute($date) {
//        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
//    }
}
