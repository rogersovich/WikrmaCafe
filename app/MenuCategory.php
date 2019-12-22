<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_categories';
    protected $fillable = [
            'name'
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
