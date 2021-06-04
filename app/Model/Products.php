<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public function brands()
    {
        return $this->belongsTo('App\Model\Brands','brand_id','id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Model\Categories', 'cate_id','id');
    }
}
