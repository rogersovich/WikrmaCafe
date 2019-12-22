<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'table',
        'status',
        'floor_id'
    ];

    public function floor()
    {
        return $this->belongsTo('App\Floor');
    }

    // UNTUK CACA
    // protected $fillable = [
    //     'judul',
    //     'pengarang',
    //     'publisher_id'
    // ];

    // public function publisher()
    // {
    //     return $this->belongsTo('App\Publisher');
    // }
}
