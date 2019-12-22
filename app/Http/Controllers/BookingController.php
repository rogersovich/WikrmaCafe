<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class BookingController extends Controller
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
        $bookings = Booking::with('Floor')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }


    public function create()
    {
        $floors = Floor::all();

        return view('admin.bookings.add', compact('floors'));
    }


    public function store(Request $request)
    {
        $floor = Floor::where('id', $request->floor_id)->first();

        if ($request->table < 10) {
            $request->table = "0".$request->table;
        }

        
        $table = 'T'.$request->table;
        //dd($table);

        Booking::create([
            'table' => $table,
            'floor_id' => $request->floor_id
        ]);

        return redirect()->route('bookings.index')->with('success','Booking berhasil di tambahkan');
    }


    public function edit(Booking $booking)
    {
        $booking = Booking::with('Floor')->where('id',$booking->id)->first();
        $floors = Floor::all();

        return view('admin.bookings.edit', compact('booking', 'floors'));
    }

    public function update(Request $request, Booking $booking)
    {
        Booking::where(['id' => $booking->id])->update([
            'table' => $request->table,
            'floor_id' => $request->floor_id
        ]);

        return redirect()->route('bookings.index')->with('success','Booking berhasil di ubah');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success','Booking berhasil di hapus');
    }
}
