<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationUrl extends Model
{
    protected $table = "navigation_urls";
    protected $fillable = ['name','url','value','icon','state','order','isAdmin'];
}
