<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ReportController extends Controller
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
        $dayNow = Carbon::now()->format('Y-m-d');
        $monthNow = Carbon::now()->format("Y-m");
        $weeks = Carbon::now()->format("W");
        $weekNow = Carbon::now()->format("Y").'-W'.$weeks;

        return view('admin.reports.index', compact('monthNow','weekNow','dayNow'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $day = $request->day;
        $week = date_format(date_create($request->week), 'W');
        $month = date_format(date_create($request->month), 'm');
        $year = date_format(date_create($request->week), 'Y');
        $weekNow = Carbon::now()->format('W');
        $monthNow = Carbon::now()->format('m');
        $dayNow = Carbon::now()->format('Y-m-d');


        if($request->jenis_laporan == 'mingguan'){

            if($request->laporan == 'barang'){

                if($week == $weekNow){

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->distinct('product_id')
                        ->get('product_id');
                    
                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory')
                                ->where('product_id', $gp->product_id)
                                ->orderBy('product_id', 'desc')
                                ->first();
                        }
    
    
                        $pdf = PDF::loadView('pdf.mingguan_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }else{

                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->distinct('product_id')
                        ->get('product_id');

                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory')
                                ->where('product_id', $gp->product_id)
                                ->orderBy('product_id', 'desc')
                                ->first();
                        }
    
    
                        $pdf = PDF::loadView('pdf.mingguan_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }

            }else{

                //pasok
                if($week == $weekNow){
                    
                    $getReport = Report::with('Product.MenuCategory')
                        ->whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');
                    
                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        $reports = [];
                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory','Product.Supplier')
                                ->where([
                                    ['product_id', '=' , $gp->product_id],
                                    ['bm_jumlah', '<>', null]
                                ])
                                ->orderBy('code', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.mingguan_pasok_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }



                }else{
                    
                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');
                    
                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        $reports = [];
    
                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory','Product.Supplier')
                                ->where([
                                    ['product_id', '=' , $gp->product_id],
                                    ['bm_jumlah', '<>', null]
                                ])
                                ->orderBy('code', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.mingguan_pasok_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }

            }

        }elseif($request->jenis_laporan == 'harian'){

            if($request->laporan == 'barang'){

                $getReport = Report::with('Product.MenuCategory')
                    ->where('tanggal',$day)
                    ->distinct('product_id')
                    ->get('product_id');
                
                if($getReport->count() == 0){
                    return redirect()->back()->with('danger', 'Data tidak ada');
                }else{

                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.MenuCategory')
                            ->where('product_id', $gp->product_id)
                            ->orderBy('product_id', 'desc')
                            ->first();
                    }
    
                    $pdf = PDF::loadView('pdf.harian_pdf', compact('reports'));
                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                }



            }else{

                //pasok
                $getReport = Report::with('Product.MenuCategory')
                    ->where('tanggal',$day)
                    ->where('bm_jumlah', '<>', null)
                    ->distinct('product_id')
                    ->get('product_id');
                
                if($getReport->count() == 0){
                    return redirect()->back()->with('danger', 'Data tidak ada');
                }else{

                    $reports = [];
                    foreach ($getReport as $gp) {
                        $reports[] = Report::with('Product.MenuCategory','Product.Supplier')
                            ->where([
                                ['product_id', '=' , $gp->product_id],
                                ['bm_jumlah', '<>', null]
                            ])
                            ->orderBy('code', 'desc')
                            ->first();
                    }
    
                    $pdf = PDF::loadView('pdf.harian_pasok_pdf', compact('reports'));
                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                
                }


            }

        }else{

            if($request->laporan == 'barang'){

                if($month == $monthNow){

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereMonth('tanggal',$monthNow)
                        ->distinct('product_id')
                        ->get('product_id');

                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory')
                                ->where('product_id', $gp->product_id)
                                ->orderBy('product_id', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.bulanan_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }else{

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereMonth('tanggal',$month)
                        ->distinct('product_id')
                        ->get('product_id');
                    
                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{
                    
                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory')
                                ->where('product_id', $gp->product_id)
                                ->orderBy('product_id', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.bulanan_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }

            }else{

                //pasok
                if($month == $monthNow){

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereMonth('tanggal',$monthNow)
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');
                    
                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{

                        $reports = [];
                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory','Product.Supplier')
                                ->where([
                                    ['product_id', '=' , $gp->product_id],
                                    ['bm_jumlah', '<>', null]
                                ])
                                ->orderBy('code', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.bulanan_pasok_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }
                    

                }else{

                    $getReport = Report::with('Product.MenuCategory')
                        ->whereMonth('tanggal',$month)
                        ->where('bm_jumlah', '<>', null)
                        ->distinct('product_id')
                        ->get('product_id');

                    if($getReport->count() == 0){
                        return redirect()->back()->with('danger', 'Data tidak ada');
                    }else{
                    
                        $reports = [];
                        foreach ($getReport as $gp) {
                            $reports[] = Report::with('Product.MenuCategory','Product.Supplier')
                                ->where([
                                    ['product_id', '=' , $gp->product_id],
                                    ['bm_jumlah', '<>', null]
                                ])
                                ->orderBy('code', 'desc')
                                ->first();
                        }
    
                        $pdf = PDF::loadView('pdf.bulanan_pasok_pdf', compact('reports'));
    
                        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
                    }


                }

            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
