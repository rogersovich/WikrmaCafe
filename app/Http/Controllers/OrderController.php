<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use App\Report;
use App\OrderDetail;
use App\Booking;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function process(Request $request)
    {

        $test = 10 < 10;
    
        // dd($test);
        $cek = $request->duit < $request->total;
        if($cek){

            return back()->with('danger','Uang Anda Tidak Cukup');

        }

        // dd($request->all());

        $date = Carbon::now();

        $order = Order::with('Booking','OrderDetails.Product')
            ->where('id', $request->order_id)
            ->first();

        $reports = $order->orderDetails()->get();

        foreach ($reports as $r) {

            // CODE Report
            $kdReport = Report::select(['code'])->max('code');

            $noUrut = (int) substr($kdReport, 5, 3);

            $noUrut++;
            $char = "RP";
            $kdReport = $char . sprintf("%05s", $noUrut);


            $report = Report::where('product_id',$r->product_id)
                ->latest()
                ->first();

            //dd($report);

            if ($report) {

                $report_akhir = Report::where('product_id', $r->product_id)
                    ->where('order_id', null)
                    ->latest()
                    ->first();

                if ($report_akhir) {
                    
                    Report::create([
                        'product_id' => $r->product_id,
                        'order_id' => $order->id,
                        'tanggal' => $date,
                        'jumlah_awal' => $report_akhir->jumlah_akhir,
                        'jumlah_jual' => $r->qty + $report->jumlah_jual,
                        'jumlah_akhir' => $report_akhir->jumlah_akhir - ($r->qty + $report->jumlah_jual),
                        'harga' => $report->harga,
                        'keterangan' => null,
                        'code' => $kdReport,
                        'jenis_laporan' => 'barang'
                    ]);

                }else{

                    Report::create([
                        'product_id' => $r->product_id,
                        'order_id' => $order->id,
                        'tanggal' => $date,
                        'jumlah_awal' => $report->jumlah_awal,
                        'jumlah_jual' => $r->qty + $report->jumlah_jual,
                        'jumlah_akhir' => $report->jumlah_awal - ($r->qty + $report->jumlah_jual),
                        'harga' => $report->harga,
                        'keterangan' => null,
                        'code' => $kdReport,
                        'jenis_laporan' => 'barang'
                    ]);

                }
            
            }else{

                $product = Product::where('id',$r->product_id)->first();

                Report::create([
                    'product_id' => $r->product_id,
                    'order_id' => $order->id,
                    'tanggal' => $date,
                    'jumlah_awal' => $product->stok + $r->qty,
                    'jumlah_jual' => $r->qty,
                    'jumlah_akhir' => $product->stok,
                    'harga' => $product->sell_price,
                    'keterangan' => null,
                    'code' => $kdReport,
                    'jenis_laporan' => 'barang'
                ]);
            }


        }

        Order::where(['id' => $request->order_id])->update([
            'change_money' => $request->duit - $request->total,
            'status' => 1
        ]);

        Booking::where(['id' => $order->booking_id])->update([
            'status' => 0
        ]);



        return redirect()->route('kasir.struk');
    }


    public function store(Request $request)
    {
        // dd('sdfsddsf');

        $user = Auth::user();

        $date = Carbon::now()->format('Y-m-d');

        $booking = Order::latest()->first();

        if($booking->booking_id == null){

            Order::where(['code' => $booking->code])->update([
                'total_price' => $request->total,
            ]);
            
        }else{

            Order::where(['booking_id' => $booking->booking_id])->update([
                'total_price' => $request->total
            ]);

        }

        foreach($request->Order as $key){
            OrderDetail::create([
                'order_id' => $booking->id,
                'product_id' => $key['product_id'],
                'qty' => $key['qty'],
                'description' => $key['desc']
            ]);
        }

        Cart::query()->truncate();

        if ($user == null) {
            return redirect()->route('kasir.orderSuccess');
        }else{
            return redirect()->route('kasir.order');
        }

    }



    public function destroy(Order $order)
    {
        //
    }
}
