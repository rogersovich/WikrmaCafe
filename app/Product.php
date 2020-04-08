<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = 'products';
    protected $fillable = [
        'menu_category_id',
        'name',
        'code_item',
        'purchase_price',
        'sell_price',
        'stok',
        'picture',
        'time',
        'is_deleted'
    ];

    public function menuCategory()
    {
        return $this->belongsTo('App\MenuCategory');
    }

    public function supplier()
    {
        return $this->hasOne('App\Supplier');
    }

    public function favorite()
    {
        return $this->hasMany('App\Favorite');
    }
}
