<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'price',
        'qty',
        'description',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
