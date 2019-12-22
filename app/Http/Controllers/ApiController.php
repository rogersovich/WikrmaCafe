<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getTables($id){

        $results = Booking::with('Floor')->where('floor_id' , $id)
            ->orderBy('id', 'asc')
            ->get();

        $active = 'blue';
        $isactive = 'red';

        return response()->json([
            'results' => $results
        ]);

    }

    public function getProducts($id){

        $results = Product::with('MenuCategory')->where('menu_category_id' , $id)
            ->orderBy('id', 'asc')
            ->get();


        return response()->json([
            'results' => $results
        ]);

    }


}
