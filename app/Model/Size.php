<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'product_size', 'size_id', 'product_id');
    }
}
