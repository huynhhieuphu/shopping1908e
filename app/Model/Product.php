<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function brands()
    {
        return $this->belongsTo('App\Model\Brand','brand_id','id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Model\Category', 'category_id','id');
    }
}
