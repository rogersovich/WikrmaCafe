<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;

class SupplierController extends Controller
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
        $suppliers = Supplier::with('Product.menuCategory')->latest()->paginate(25);

        return view('admin.suppliers.index')->with(compact('suppliers'));
    }

   
    public function pasok(Request $request)
    {
        $pasok = [];

        foreach ($request->pasok as $val) {

            $product = Supplier::with('Product.menuCategory')->find($val);
            //dd($product);
            $pasok[] = [
                'id' => $product->Product->id,
                'harga' => $product->purchase_price,
                'name' => $product->Product->name,
                'stok' => $product->Product->stok,
                'category' => $product->Product->MenuCategory->name
            ];
            //dd($pasok);

        }


        return view('admin.suppliers.pasok', compact('pasok'));
    }

   
    public function store(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        // dd($request->all());
        foreach ($request->pasok as $val) {

            // CODE Report
            $kdReport = Report::select(['code'])->max('code');
            $noUrut = (int) substr($kdReport, 5, 3);
            $noUrut++;
            $char = "RP";
            $kdReport = $char . sprintf("%05s", $noUrut);

            // $report = Report::where([
            //     ['product_id', '=' , $val['id'] ],
            //     ['bm_jumlah', '<>', null],
            // ])
            // ->latest()
            // ->first();

            $report = Report::where('product_id',$val['id'])
                ->latest()
                ->first();

            //dd($report);

            if ($report == null) {          
                
                $product = Product::where('id',$val['id'])->first();
                
                Report::create([
                    'product_id' => $val['id'],
                    'order_id' => null,
                    'tanggal' => $date,
                    'jumlah_awal' => $product->stok,
                    'bm_jumlah' => $val['qty'],
                    'jumlah_akhir' => $product->stok + $val['qty'],
                    'harga' => $product->purchase_price,
                    'keterangan' => null,
                    'status' => 1,
                    'code' => $kdReport,
                    'jenis_laporan' => 'pasok'
                ]);

            }else{
                
                Report::create([
                    'product_id' => $val['id'],
                    'order_id' => null,
                    'tanggal' => $date,
                    'jumlah_awal' => $report->jumlah_awal,
                    'bm_jumlah' => $val['qty'] + $report->bm_jumlah,
                    'jumlah_akhir' => $report->jumlah_awal + ($val['qty'] + $report->bm_jumlah),
                    'harga' => $report->harga,
                    'keterangan' => null,
                    'status' => 1,
                    'code' => $kdReport,
                    'jenis_laporan' => 'pasok'
                ]);

            }

            //BATAS

            // dd($val);

            $product = Product::with('MenuCategory')->find($val['id']);
            
            Product::where(['id' => $val['id']])->update([
                'stok' => $product->stok + $val['qty']
            ]);

            Supplier::where(['product_id' => $val['id']])->update([
                'purchase_price' => $val['purchase_price']
            ]);

        }


        return redirect()->route('suppliers.index');
    }

    
    public function edit(Supplier $supplier)
    {
        $suppliers = Supplier::with('Product.MenuCategory')
            ->where('id', $supplier->id)
            ->first();

        return view('admin.suppliers.edit')->with(compact('suppliers'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        Supplier::where(['id' => $supplier->id])->update([
            'purchase_price' => $request->purchase_price
        ]);


        return redirect()->route('suppliers.index');
    }

    
    public function updatePasok(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)->first();
        $product = Product::where('id', $supplier->product_id)->first();

        Product::where(['id' => $supplier->product_id])->update([
            'stok' => $product->stok + $request->jumlah
        ]);


        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
