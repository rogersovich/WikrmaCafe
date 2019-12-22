<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FloorController extends Controller
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
        $floors = Floor::paginate(15);

        return view('admin.floors.index', compact('floors'));
    }


    public function create()
    {
        return view('admin.floors.add');
    }


    public function store(Request $request)
    {
        Floor::create([
            'name' => $request->name
        ]);

        return redirect()->route('floors.index')->with('success','Floor berhasil di tambahkan');
    }


    public function edit(Floor $floor)
    {
        return view('admin.floors.edit', compact('floor'));
    }


    public function update(Request $request, Floor $floor)
    {
        Floor::where(['id' => $floor->id])->update([
            'name' => $request->name
        ]);

        return redirect()->route('floors.index')->with('success','Floor berhasil di ubah');
    }


    public function destroy(Floor $floor)
    {
        $floor->delete();

        return redirect()->route('floors.index')->with('success','Floor berhasil di hapus');
    }
}
