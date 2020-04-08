<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Product;
use App\OrderDetail;
use App\MenuCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FavoriteController extends Controller
{
    public function grafik()
    {   
        $name_category = [];
        $name_categories = [];
        $dessert = [];
        $makanan = [];
        $labelDessert = [];
        $labelMakanan = [];
        
        $categories = MenuCategory::all();
        foreach ($categories as $c) {
            $name_category['category'][] = $c->name;
            $name_categories['data'] = [];
        }

        $favorites = Favorite::with('Product.menuCategory')->get();
        foreach ($favorites as $f) {
            array_push($name_categories['data'], [
                'type' =>  $f->Product->menuCategory->name,
                'product' => $f->Product->name,
                'point' => $f->point
                ]);
        }
        
        $combine = array_merge($name_category, $name_categories);
        
        if ($combine == []) {
            
        }else{

            foreach ($combine['data'] as $key => $cd) {
                if ($cd['type'] == 'Dessert') {
                    $dessert[] = $cd['point'];
                    $labelDessert[] = $cd['product'];
                }elseif($cd['type'] == 'Makanan'){
                    $makanan[] = $cd['point'];
                    $labelMakanan[] = $cd['product'];
                }
            }
        }
        
            
        

        // Keuntungan
        $date = Carbon::now()->format('Y-m-d');
        
        $sold = [];
        $id_sold = [];
        $sell_price_arr = [];
        $buy_price_arr = [];
        $harga_beda = [];
        $data = OrderDetail::where(['tanggal' => $date])->get();
        
        foreach ($data as $d) {
            array_push($id_sold, $d->product_id);
            array_push($sold, $d->qty);
        }
        
        $id_sold = array_unique($id_sold);
        
        foreach ($id_sold as $is) {
            $p = Product::where(['id' => $is])->first();
            
            array_push($sell_price_arr, $p->sell_price);
            array_push($buy_price_arr, $p->purchase_price);
            array_push($harga_beda, ($p->sell_price - $p->purchase_price));
        }

        
        $total_beda = array_sum($sold) * array_sum($harga_beda);
        $total_jual = array_sum($sold) * array_sum($sell_price_arr); //uang masuk
        $total_beli = array_sum($sold) * array_sum($buy_price_arr); //uang keluar
        $total_all = $total_jual - $total_beli;
        $rugi = 0;
        $untung = 0;

        if ($total_all == $total_beda) {
            $untung = $total_all;
        }elseif($total_all >= $total_beda){
            $untung = $total_all;
        }else{
            $rugi = $total_all;
        }
        
        

        return view('admin.favorites.grafik', compact('dessert','labelDessert','makanan','labelMakanan','total_jual','total_beli','rugi','untung'));
    }

}
