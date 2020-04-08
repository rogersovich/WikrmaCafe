<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable= [
        'product_id',
        'point',
        'menu_category_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
