<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected  $table = 'offers' ;
    protected $fillable=['name_en' ,'photo' ,'name_ar','price' , 'details_en' , 'details_ar', 'created_at' , 'updated_at' ,'status'];
    protected $hidden = ['created_at' , 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }


    ######################### local scopes ####################
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeInvalid($query)
    {
        return $query->where('status', 0)->whereNull('details_ar');
    }

    #########################################################

    //mutators

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = strtoupper($value);
    }

}
