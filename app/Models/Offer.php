<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected  $table = 'offers' ;
    protected $fillable=['name_en' ,'photo' ,'name_ar','price' , 'details_en' , 'details_ar', 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at'];


}
