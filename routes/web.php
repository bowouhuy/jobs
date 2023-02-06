<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/* HELPER */
use App\Http\Controllers\HelperController;
/* USER */
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\JasaController;
use App\Http\Controllers\user\InvoiceController;
use App\Http\Controllers\user\TransaksiController as UserTransaksiController;
/* ADMIN */
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JasaController as AdminJasaController;
use App\Http\Controllers\admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\admin\SubKategoriController as AdminSubKategoriController;
use App\Http\Controllers\admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\admin\MitraController as AdminMitraController;
use App\Http\Controllers\admin\CustomerController as AdminCustomerController;

/* ADMIN */
use App\Http\Controllers\mitra\DashboardMitraController;
use App\Http\Controllers\mitra\MitraJasaController as MitraJasaController;
use App\Http\Controllers\mitra\TransaksiController as MitraTransaksiController;
use App\Http\Controllers\mitra\OrderController as MitraOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/* ROUTE USER */


Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('profile', [HomeController::class, 'profile']);
    Route::get('read-xml', [\App\Http\Controllers\ReadXmlController::class, 'index']);

    Route::prefix('jasa')->group(function () {
        Route::post('{subkategori_id?}', [JasaController::class, 'index']);
        Route::get('{subkategori_id?}', [JasaController::class, 'index']);
        Route::get('detail/{jasa_id}', [JasaController::class, 'show']);
        Route::get('invoice/{paket_id}', [InvoiceController::class, 'index'])->middleware('auth.user');
    });
    Route::prefix('invoice')->group(function () {
        Route::post('store', [InvoiceController::class, 'store']);
        Route::get('delete_files/{filename}', [InvoiceController::class, 'delete_files']);
    });
    Route::get('profile/list',[UserTransaksiController::class,'list']);
    Route::get('profile/order',[UserTransaksiController::class,'listorder']);
    Route::get('profile/order/download',[UserTransaksiController::class,'getDownload']);
    // Route::prefix('faq')->group(function () {
    //     Route::get('1', function(){return view('user.faq.1');});
    // });
});

/* ROUTE ADMIN */
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::prefix('jasa')->group(function () {
        Route::get('/', [AdminJasaController::class, 'index']);
        Route::get('list', [AdminJasaController::class, 'list']);
        Route::get('form_jasa/{jasa_id?}', [AdminJasaController::class, 'form_jasa']);
        Route::post('form_jasa_store', [AdminJasaController::class, 'form_jasa_store']);
        Route::get('form_images/{jasa_id}', [AdminJasaController::class, 'form_images']);
        Route::post('form_images_store', [AdminJasaController::class, 'form_images_store']);
        Route::get('form_paket/{jasa_id}', [AdminJasaController::class, 'form_paket']);
        Route::post('form_paket_store', [AdminJasaController::class, 'form_paket_store']);
        Route::get('delete_files/{filename}', [AdminJasaController::class, 'delete_files']);
        Route::get('delete_jasa/{jasa_id}', [AdminJasaController::class, 'delete_jasa']);
        Route::get('delete_paket/{paket_id}', [AdminJasaController::class, 'delete_paket']);
    });
    Route::prefix('kategori')-> group(function (){
        Route::get('/',[AdminKategoriController::class,'index']);
        Route::get('list',[AdminKategoriController::class,'list']);
        Route::post('form_kategori_store', [AdminKategoriController::class, 'form_kategori_store']);
        Route::get('create',[AdminKategoriController::class,'create']);
        Route::get('delete_kategori/{kategori_id}', [AdminKategoriController::class, 'delete_kategori']);
        Route::get('form_kategori/{kategori_id?}', [AdminKategoriController::class, 'form_kategori']);
        Route::get('edit/{id}',[AdminKategoriController::class,'edit']);
        Route::post('update/{id}',[AdminKategoriController::class, 'update']);


    });
    Route::prefix('subkategori')-> group(function (){
        Route::get('/',[AdminSubKategoriController::class,'index']);
        Route::get('list',[AdminSubKategoriController::class,'list']);
        Route::get('delete_subkategori/{subkategori_id}',[AdminSubKategoriController::class , 'delete_subkategori']);
        Route::post('form_subkategori_store', [AdminSubKategoriController::class, 'form_subkategori_store']);
        Route::get('create',[AdminSubKategoriController::class,'create']);
        Route::get('edit/{id}',[AdminSubKategoriController::class,'edit']);
        Route::post('update/{id}',[AdminSubKategoriController::class, 'update']);

    });
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [AdminTransaksiController::class, 'index']);
        Route::get('list',[AdminTransaksiController::class,'list']);
        Route::post('store',[AdminTransaksiController::class,'store']);
        Route::get('/export',[AdminTransaksiController::class,'export']);
    });
    Route::prefix('mitra')->group(function () {
        Route::get('/', [AdminMitraController::class, 'index']);
        Route::get('list',[AdminMitraController::class,'list']);
        Route::post('store',[AdminMitraController::class,'store']);
    });
    Route::prefix('customer')->group(function () {
        Route::get('/', [AdminCustomerController::class, 'index']);
        Route::get('list',[AdminCustomerController::class,'list']);
    });
});


Route::prefix('mitra')->middleware('auth.mitra')->group(function () {
    Route::get('/', [DashboardMitraController::class, 'index']);
    Route::prefix('jasa')->group(function () {
        Route::get('/', [MitraJasaController::class, 'index']);
        Route::get('list', [MitraJasaController::class, 'list']);
        Route::get('form_jasa/{jasa_id?}', [MitraJasaController::class, 'form_jasa']);
        Route::post('form_jasa_store', [MitraJasaController::class, 'form_jasa_store']);
        Route::get('form_images/{jasa_id}', [MitraJasaController::class, 'form_images']);
        Route::post('form_images_store', [MitraJasaController::class, 'form_images_store']);
        Route::get('form_paket/{jasa_id}', [MitraJasaController::class, 'form_paket']);
        Route::post('form_paket_store', [MitraJasaController::class, 'form_paket_store']);
        Route::get('delete_files/{filename}', [MitraJasaController::class, 'delete_files']);
        Route::get('delete_jasa/{jasa_id}', [MitraJasaController::class, 'delete_jasa']);
        Route::get('delete_paket/{paket_id}', [MitraJasaController::class, 'delete_paket']);
    });
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [MitraTransaksiController::class, 'index']);
        Route::get('list',[MitraTransaksiController::class,'list']);
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [MitraOrderController::class, 'index']);
        Route::get('list',[MitraOrderController::class,'list']);
        Route::post('form_order_store', [MitraOrderController::class, 'form_order_store']);
        Route::get('delete_files/{filename}', [MitraOrderController::class, 'delete_files']);
    });
});
/* ROUTE AUTH */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('loginUser', [AuthController::class, 'loginUser']);
Route::post('createUser', [AuthController::class, 'createUser']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


/* ROUTE HELPER */
Route::prefix('helper')->group(function () {
    Route::get('get_subkategori/{kategori_id}/{subkategori_id?}', [HelperController::class, 'get_subkategori']);
    Route::get('get_paket/{paket_id}', [HelperController::class, 'get_paket']);
    Route::get('get_jasa_images/{jasa_id}', [HelperController::class, 'get_jasa_images']);
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/clear-route', function() {
    Artisan::call('route:clear');
    return "Route is cleared";
});

Route::get('admin/jasa/listxml', [AdminJasaController::class, 'listxml']);