<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Session;

class RoleController extends Controller
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
        $roles = Role::paginate(15);

        return view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        return view('admin.roles.add');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        Role::create([
            'name' => $request->name
        ]);

        return redirect('admin/roles')->with('success','Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = Role::where(['id' => $id])->first();
        //dd($role);

        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        Role::where(['id' => $id])->update([
            'name' => $request->name
        ]);

        return redirect('admin/roles')->with('success','Role berhasil di rubah');
    }


    public function destroy($id)
    {
        $role = Role::where(['id' => $id])->first();
        $role->delete();

        return redirect('admin/roles')->with('success','Role berhasil di hapus');
    }
}
