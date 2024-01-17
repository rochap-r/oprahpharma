<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Template user interface
Route::prefix('app')->name('app.')->middleware(['auth','check_permissions'])->group(function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/user.profile',[UserController::class,'profile'])->name('user.profile');
    Route::post('/changeImage',[UserController::class,'changeImage'])->name('changeImage');
    Route::get('/user.index',[UserController::class,'index'])->name('user.index');
    Route::get('/role.index',[RoleController::class,'index'])->name('role.index');
    Route::get('/permission.index',[PermissionController::class,'index'])->name('permission.index');
    Route::get('/product.index',[ProductController::class,'index'])->name('product.index');
    Route::get('/unit.index',[UnitController::class,'index'])->name('unit.index');
    Route::get('/supply.index',[SupplyController::class,'index'])->name('supply.index');
    Route::get('/supply.product/{id}',[SupplyController::class,'product'])->name('supply.product');
    Route::get('/supply.products',[SupplyController::class,'products'])->name('supply.products');
    Route::get('/order.index',[OrderController::class,'index'])->name('order.index');
    Route::get('/report.index',[ReportController::class,'index'])->name('report.index');
    Route::get('/report.stock-report',[ReportController::class,'StockReport'])->name('report.stock-report');
    Route::get('/report.expiration-report',[ReportController::class,'ExpirationReport'])->name('report.expiration-report');

});

Route::get('/', function () {
    return redirect()->route('app.home');
});



Route::get('/login', function () {
    return view('login');
});

require __DIR__.'/auth.php';

