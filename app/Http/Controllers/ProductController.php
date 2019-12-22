<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Supplier;
use App\MenuCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $role = $user->roles->first()->pivot->role_id;

            if ($role == 2) {
                return redirect('home/');
            }else{
                if($user){
                    $data = collect([
                        'name' => $user->name,
                        'email' => $user->email,
                        'id' => $user->id,
                        'role_id' => $role,
                    ]);
                    Session::put('user', $data);
                }

                return $next($request);
            }
        });
    }

    public function index()
    {

        $data = Product::with('menuCategory')->paginate(15);
        return view('admin.products.index', compact('data'));
    }


    public function create()
    {
        $categories = MenuCategory::all();

        return view('admin.products.add', compact('categories'));
    }


    public function store(Request $request)
    {


        $kdBarang = Product::select(['code_item'])->max('code_item');

        $noUrut = (int) substr($kdBarang, 5, 3);

        $noUrut++;
        $char = "BR";
        $kdBarang = $char . sprintf("%05s", $noUrut);
        //dd($kdBarang);

        $gambar = $request->file('picture');
        
        $namafile = Carbon::now()->format('Ymd'). '_' . uniqid() .'.'. $gambar->getClientOriginalExtension();
        $gambar->move(public_path('upload/products/'),$namafile);
        
        Product::create([
            'menu_category_id' => $request->menu_category_id,
            'name' => ucwords($request->name),
            'code_item' => $kdBarang,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'stok' => $request->stok,
            'picture' => $namafile,
            'time' => $request->time,
            'is_deleted' => 0
        ]);

        //dd('sdfsd');

        $getProduct = Product::orderBy('id', 'desc')->first();

        Supplier::create([
            'product_id' => $getProduct->id,
            'purchase_price' => $request['purchase_price'],
        ]);

        return redirect('admin/products')->with('success','Produk berhasil di tambahkan');
    }

    public function edit($id)
    {
        $product = Product::with('menuCategory')->where('id',$id)->first();
        $categories = MenuCategory::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        //dd($request->all());
        if($product->picture == $request['picture']){
            $fotoLama = $request['picture'];
        }else{
            $fotoLama = $product->picture;
        }

        //dd($fotoLama);

        $foto = $request->file('picture');

        if(empty($foto)){
            $foto = $fotoLama;
            $namabaru = $foto;
        }else{
            $foto = $request->file('picture');
            $namabaru = Carbon::now()->format('Ymd'). '_' . uniqid() . $foto->getClientOriginalExtension();
            $foto->move(public_path('upload/products/'),$namabaru);
            unlink(public_path('\upload\products\\'.$fotoLama));
        }

        Product::where('id', $id)->update([
            'menu_category_id' => $request->menu_category_id,
            'name' => $request->name,
            'code_item' => $product->code_item,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'stok' => $request->stok,
            'picture' => $namabaru,
            'time' => $request->time
        ]);

        return redirect('admin/products')->with('success','Produk berhasil di update');

    }


    public function destroy($id)
    {
        $data = Product::find($id);
        unlink(public_path('\upload\products\\'.$data->picture));
        $data->delete();


        return redirect('/admin/products')->with('success','Produk berhasil di hapus');
    }
}
