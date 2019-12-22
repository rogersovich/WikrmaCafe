<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AccountController extends Controller
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
        $accounts = User::with('Roles')
            ->orderBy('status', 'desc')
            ->paginate(15);

        return view('admin.accounts.index', compact('accounts'));
    }

    public function edit($id)
    {
        $roles = Role::all();
        $account = User::with('Roles')
            ->where('id', $id)
            ->first();

        return view('admin.accounts.edit', compact('account','roles'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $user = User::with('Roles')->where(['id' =>  $id])->first();

        if ($request->password == null) {

            User::where(['id' => $id])->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status
            ]);

        }else{

            User::where(['id' => $id])->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status,
                'password' => Hash::make($request->password)
            ]);

        }


        $user->roles()->detach(Role::where('id', $user->Roles[0]->id)->first());
        $user->roles()->attach(Role::where('id', $request->role_id)->first());

        return redirect('admin/accounts')->with('success','Akun berhasil di ubah');
    }

    public function accept($id)
    {
        $user = User::where(['id' =>  $id])->first();

        User::where(['id' => $id])->update([
            'status' => 1,
        ]);

        return redirect('admin/accounts')->with('success','Akun berhasil di ubah');
    }

    public function destroy($id)
    {
        $user = User::where(['id' => $id])->first();
        $user->delete();

        return redirect('admin/accounts')->with('success','Akun berhasil di hapus');
    }
}
