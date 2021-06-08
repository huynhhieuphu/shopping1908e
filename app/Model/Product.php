<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function brand()
    {
        return $this->belongsTo('App\Model\Brand','brand_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id','id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Model\Color', 'product_color','product_id', 'color_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'product_tag', 'product_id', 'tag_id');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Model\Size', 'product_size', 'product_id', 'size_id');
    }
}
