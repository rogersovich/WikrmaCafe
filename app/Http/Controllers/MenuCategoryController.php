<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\MenuCategory;
use Illuminate\Support\Facades\Auth;
use Session;


class MenuCategoryController extends Controller
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
        $data = MenuCategory::paginate(15);
        return view('admin.categories.index', compact('data'));
    }


    public function create()
    {
        return view('admin.categories.add');
    }


    public function store(Request $request)
    {
        MenuCategory::create([
            'name' => $request->name
        ]);

        return redirect('admin/categories')->with('success','Kategori berhasil di tambahkan');
    }

    public function edit($id)
    {
        $category = MenuCategory::find($id);

        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {

        MenuCategory::where(['id' => $id])->update([
            'name' => $request->name
        ]);


        return redirect('admin/categories')->with('success','Kategori berhasil di ubah');
    }


    public function destroy($id)
    {
        $category = MenuCategory::find($id);
        $category->delete();


        return redirect('/admin/categories')->with('success','Kategori berhasil di hapus');
    }
}
