<?php

use App\Role;


// batas nya

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');


// ROUTE GROUP //

Route::prefix('kasir')->group(function () {

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/order', 'CashierController@order')->name('kasir.order');
        Route::get('/payment', 'CashierController@payment')->name('kasir.payment');
        Route::get('/order/cancel/{id}', 'CashierController@cancelProcess')->name('kasir.cancelProcess');
        Route::get('/payment/{id}', 'CashierController@process')->name('kasir.process');
        Route::post('/process', 'OrderController@process')->name('kasir.order.process');
        Route::get('/struk', 'CashierController@struk')->name('kasir.struk');
        Route::get('/struk/print/{id}', 'CashierController@print')->name('kasir.struk.print');
        
        Route::resource('carts', 'CartController')->except([
            'show','destroy','index'
        ]);
    });

    Route::get('/', 'CashierController@home')->name('kasir.home');
    Route::get('/table', 'CashierController@table')->name('kasir.table');
    Route::get('/bookTable/{id}', 'CashierController@bookTable')->name('kasir.bookTable');
    Route::get('/table/search','CashierController@searchTable')->name('kasir.tableSearch');
    Route::get('/menu/search','CashierController@searchMenu')->name('kasir.menuSearch');
    Route::get('/order/search','CashierController@searchOrder')->name('kasir.orderSearch');
    
    
    Route::resource('orders', 'OrderController')->except([
        'show','destroy','index'
    ]);

});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', 'HomeController@dashboard')->name('dashboard');

    Route::resource('categories', 'MenuCategoryController')->except([
        'show','destroy'
    ]);

    Route::resource('products', 'ProductController')->except([
        'show','destroy'
    ]);

    Route::resource('roles', 'RoleController')->except([
        'show','destroy'
    ]);

    Route::resource('accounts', 'AccountController')->except([
        'show','destroy','create','store'
    ]);

    Route::resource('suppliers', 'SupplierController')->except([
        'show','destroy'
    ]);

    Route::resource('reports', 'ReportController')->except([
        'show','destroy'
    ]);

    // KASIR

    Route::resource('floors', 'FloorController')->except([
        'show','destroy'
    ]);

    Route::resource('bookings', 'BookingController')->except([
        'show','destroy'
    ]);


});

// CUSTOM //

Route::get('/signUp', function () {

    $roles = Role::where('name','<>','Admin')->get();
    return view('layouts.pages.register_custom', compact('roles'));

})->name('signUp');

Route::get('/signIn', function () {

    return view('layouts.pages.login_custom');
})->name('signIn');

// AJAX
Route::get('/getTables/{id}', 'ApiController@getTables')->name('getTables');
Route::get('/getProducts/{id}', 'ApiController@getProducts')->name('getProducts');

Route::get('/kasir/orders/success', 'CashierController@orderSuccess')->name('kasir.orderSuccess');
Route::get('/kasir/menu', 'CashierController@menu')->name('kasir.menu');
Route::get('/kasir/takeaway', 'CashierController@takeaway')->name('kasir.takeaway');
Route::post('/kasir/pesenMenu', 'CashierController@pesenMenu')->name('kasir.pesenMenu');
Route::post('/regiter/process', 'RegisterCustomController@register')->name('register.process');
Route::get('/kasir/table/{table}','RoleController@destroy')->name('roles.destroy');


Route::get('/categories/{category}','MenuCategoryController@destroy')->name('categories.destroy');
Route::get('/products/{product}','ProductController@destroy')->name('products.destroy');
Route::get('/roles/{role}','RoleController@destroy')->name('roles.destroy');
Route::get('/floors/{floor}','FloorController@destroy')->name('floors.destroy');
Route::get('/bookings/{booking}','BookingController@destroy')->name('bookings.destroy');
Route::get('/accounts/{account}','AccountController@destroy')->name('accounts.destroy');
Route::get('/accounts/accept/{id}','AccountController@accept')->name('accounts.accept');
Route::get('/carts/{cart}','CartController@destroy')->name('carts.destroy');

Route::put('/suppliers/{updatePasok}','SupplierController@updatePasok')->name('suppliers.updatePasok');
Route::post('/admin/suppliers/pasok','SupplierController@pasok')->name('suppliers.pasok');

Auth::routes();

