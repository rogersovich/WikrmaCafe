<?php

namespace App\Http\Controllers;

use PDF;
use Session;
use App\Floor;
use App\Booking;
use App\Product;
use App\Cart;
use App\MenuCategory;
use App\Order;
use App\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function home(){

        $user = Auth::user();

        if($user == null){

        }else{
            $role = $user->roles->first()->pivot->role_id;
            $data = collect([
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'role_id' => $role,
            ]);
            Session::put('user', $data);
        }

        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        return view('kasir.index', compact('count','cart','total','user'));
    }

    public function table($name){

        $user = Auth::user();

        if($user == null){

        }else{
            $role = $user->roles->first()->pivot->role_id;
            $data = collect([
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'role_id' => $role,
            ]);
            Session::put('user', $data);
        }

        // dd($name);

        $floors = Floor::all();
        $bookings = Booking::all();
        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        $date = Carbon::now();

         // CODE ORDER
         $kdOrder = Order::select(['code'])->max('code');

         $noUrut = (int) substr($kdOrder, 5, 3);
 
         $noUrut++;
         $char = "OR";
         $kdOrder = $char . sprintf("%05s", $noUrut);


        if($user){

        }else{
            Order::create([
                'name' => $name,
                'code' => $kdOrder,
                'tanggal' => $date,
                'status' => 0,
            ]);
        }


        return view('kasir.table', compact('floors','bookings','count','cart','total','user'));
    }

    public function takeaway($name){
        // dd($name);
        $date = Carbon::now();

        // CODE ORDER
        $kdOrder = Order::select(['code'])->max('code');

        $noUrut = (int) substr($kdOrder, 5, 3);

        $noUrut++;
        $char = "OR";
        $kdOrder = $char . sprintf("%05s", $noUrut);

        $menus = MenuCategory::all();
        $products = Product::with('MenuCategory')->get();

        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);

        Order::create([
            'name' => $name,
            'status' => 0,
            'code' => $kdOrder,
            'tanggal' => $date
        ]);

        return redirect()->route('kasir.menu', compact('menus','products','cart','total'));
    }

    public function menu(){

        $user = Auth::user();

        if($user == null){

        }else{
            $role = $user->roles->first()->pivot->role_id;
            $data = collect([
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'role_id' => $role,
            ]);
            Session::put('user', $data);
        }

        $menus = MenuCategory::all();

        $cart = Cart::with('Product')->get();
        $count = $cart->count();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);

        $products = null;

        return view('kasir.menu', compact('products', 'menus','cart','total','count','user'));
    }

    public function bookTable($id){

        // dd('test');
        $date = Carbon::now();
        
        $booking = Booking::where('id', $id)->first();
        $order = Order::latest('id')->first();
        //dd($order);

        Booking::where(['id' => $id])->update([
            'status' => 1
        ]);

        Order::where(['id' => $order->id])->update([
            'booking_id' => $booking->id
        ]);

        return redirect()->route('kasir.menu');

    }

    public function pesenMenu(Request $request){

        //dd($request->all());


        $product = Product::where('id', $request->product_id)->first();
        
        $jumlah_lama = $product->stok;

        $cek = $request->jumlah <= $jumlah_lama;
        
        if($cek == false){

            return redirect()->route('kasir.menu')->with('danger','Jumlah Barang Tidak Cukup');

        }

        $cekCart = Cart::where('product_id', $request->product_id)
            ->first();

        

        if(!$cekCart == null){

            $product = Product::where('id', $request->product_id)->first();

            Product::where(['id' => $request->product_id])->update([
                'stok' => $product->stok - $request->jumlah,
            ]);

            if ($request->description == null) {

                $cart = Cart::where(['product_id' => $request->product_id])->update([
                    'qty' => $cekCart->qty + $request->jumlah,
                    'description' => '-'
                ]);
                
            }else{

                $cart = Cart::where(['product_id' => $request->product_id])->update([
                    'qty' => $cekCart->qty + $request->jumlah,
                    'description' =>$request->description
                ]);

            }


        }else{

            if ($request->description == null) {

                $cart = Cart::create([
                    'price' => $request->harga,
                    'qty' => $request->jumlah,
                    'product_id' => $request->product_id,
                    'description' => '-'
                ]);

            }else{

                $cart = Cart::create([
                    'price' => $request->harga,
                    'qty' => $request->jumlah,
                    'product_id' => $request->product_id,
                    'description' =>$request->description
                ]);

            }

            Product::where(['id' => $cart->product_id])->update([
                'stok' => $product->stok - $cart->qty,
            ]);

        }



        return redirect()->route('kasir.menu');

    }

    public function process($id){

        $user = Auth::user();

        $order = Order::with('Booking','OrderDetails.Product')->where('id', $id)->first();

        $orders = Order::with('Booking','OrderDetails.Product')
            ->where('status', 0)
            ->get();

        $orderDetails = OrderDetail::with('Product')
            ->where('order_id', $order->id)
            ->get();

        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        return view('kasir.payment', compact('orders','id','order','orderDetails', 'count','cart','total','user'));
    }

    public function order(){

        $user = Auth::user();

        if($user == null){

        }else{
            $role = $user->roles->first()->pivot->role_id;
            $data = collect([
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'role_id' => $role,
            ]);
            Session::put('user', $data);
        }

        

        $progress = Order::where('status', 0)
            ->get();
        // dd($progress);

        $complete = Order::with('Booking','OrderDetails.Product')
            ->where('status', 1)
            ->get();

        $progressCount = $progress->count();
        $completeCount = $complete->count();

        if($complete->isEmpty()){
            $complete = null;
        }
        
        if($progress->isEmpty()){
            $progress = null;
        }

        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        return view('kasir.order', compact('user','progress','complete','progressCount','total','cart','completeCount','count'));
    }

    public function struk(){

        $report = Order::latest()->first();

        $data = OrderDetail::with('Product.MenuCategory')
                ->where('order_id', $report->id)->get();

        return view('layouts.pages.struk', compact('report','data'));
    }

    public function print($id){

        $data = Order::find($id);
        $order_details = OrderDetail::with('Product.MenuCategory')
            ->where('order_id', $data->id)->get();

        // $order = Order::where('id', $data->id)->first();

        $pdf = PDF::loadView('pdf.kasir_pdf', compact('data','order_details'));

        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

    }

    public function cancelProcess($id){

        $order = Order::find($id);
        $order->delete();

        return redirect()->route('kasir.order');
    }

    public function searchTable(Request $request){

        $cari = $request->search;

        $floors = Floor::all();
        $bookings = Booking::all();
        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        $tables = Booking::where('floor_id', $request->floor_id)
            ->where('table', 'like', '%'.$cari.'%')
            ->get();
    
            // mengirim data pegawai ke view index
        return view('kasir.table', compact('floors', 'tables', 'total', 'count','cart'));


    }

    public function searchMenu(Request $request){
        
        $cari = $request->search;

        $cart = Cart::with('Product')->get();
        $tampung = [];

        foreach ($cart as $c) {

            $tampung[] = $c->price * $c->qty;
        }

        $total = array_sum($tampung);
        $count = $cart->count();

        $menus = MenuCategory::all();
        // $products = Product::with('MenuCategory')->get();
        $products = Product::where('menu_category_id', $request->menu_id)
            ->where('name', 'like', '%'.$cari.'%')
            ->get();

        // dd($products);
    
            // mengirim data pegawai ke view index
        return view('kasir.menu', compact('products', 'menus' ,'total', 'count','cart'));


    }
    

    public function payment(){

        $user = Auth::user();
        return view('kasir.payment', compact('user'));
    }

    public function orderSuccess(){

        return view('kasir.success_order');
    }   
}
