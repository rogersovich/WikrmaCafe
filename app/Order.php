<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'name',
        'total_price',
        'change_money',
        'tanggal',
        'booking_id',
        'status'
    ];

    public function booking()
    {
        return $this->belongsTo('App\Booking');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetail');
    }

}
