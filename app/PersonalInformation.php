<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = "personal_informations";
    protected $fillable = ['siteName','firstName','lastName','email','country','phoneNumber','photoId','description','faceBook','twitter','googlePlus'];
}
