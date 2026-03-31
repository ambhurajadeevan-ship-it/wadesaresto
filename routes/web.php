<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\ReservasiAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Galeri;
use App\Models\Menu;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\SettingController;


/*
|--------------------------------------------------------------------------
| AUTH CUSTOMER
|--------------------------------------------------------------------------
*/
Route::get('/login', [App\Http\Controllers\Auth\CustomerAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\CustomerAuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Auth\CustomerAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\CustomerAuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\Auth\CustomerAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/menu', function () {
    $menus = \App\Models\Menu::all();
    return view('menu', compact('menus'));
});
Route::get('/semua-menu', function () {
    $kategori = request('kategori');
    if ($kategori) {
        $menus = \App\Models\Menu::where('kategori', $kategori)->get();
    } else {
        $menus = \App\Models\Menu::all();
    }
    return view('menu-all', compact('menus', 'kategori'));
})->name('menu.all');

Route::middleware('auth')->group(function () {
    Route::get('/booking', [ReservasiController::class, 'create'])->name('booking.create');
    Route::post('/booking', [ReservasiController::class, 'store'])->name('booking.store');
    Route::get('/payment/{id}', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/{id}', [App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
    Route::get('/check-availability', [ReservasiController::class, 'checkAvailability']);
    Route::get('/booking/confirmation/{id}', [ReservasiController::class, 'confirmation'])
        ->name('booking.confirmation');
    Route::get('/get-meja/{id_area}', function($id){
        return \App\Models\Meja::where('id_area',$id)->get();
    });
    Route::post('/booking/check', [ReservasiController::class,'checkAvailability'])->name('booking.check');
    Route::get('/riwayat-reservasi', [ReservasiController::class, 'history'])->name('booking.history');
});

Route::get('/cancel/{kode}', 
    [ReservasiController::class,'cancelFromEmail']
)->name('reservasi.cancel')->middleware('signed');

Route::post('/cancel/{kode}', 
    [ReservasiController::class,'cancelFromPage']
)->name('reservasi.cancel.page');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

    // DASHBOARD
    Route::get('/search',
        [DashboardController::class, 'search'])
        ->name('admin.search');
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/dashboard/latest-reservasi', 
        [DashboardController::class, 'latestReservasi'])
        ->name('admin.dashboard.latest');

    // RESERVASI
    Route::get('/reservasi',
        [ReservasiAdminController::class, 'index'])
        ->name('admin.reservasi');

    Route::post('/reservasi/{id}/status',
        [ReservasiAdminController::class, 'updateStatus'])
        ->name('admin.reservasi.status');

    Route::delete('/reservasi/{id}',
        [ReservasiAdminController::class, 'destroy'])
        ->name('admin.reservasi.destroy');
    Route::get('/reservasi/json',
        [ReservasiAdminController::class,'getJson'])
        ->name('admin.reservasi.json');


    // PROFILE
    Route::get('/profile',
        [ProfileController::class,'index'])
        ->name('admin.profile');

    Route::put('/profile/update',
        [ProfileController::class,'update'])
        ->name('admin.profile.update');

    // AREA
    Route::get('/area', [AreaController::class,'index'])
        ->name('admin.area');
    Route::post('/area', [AreaController::class,'store'])
        ->name('admin.area.store');
    Route::delete('/area/{id}', [AreaController::class,'destroy'])
        ->name('admin.area.delete');
    Route::get('/area/create', [AreaController::class,'create'])
        ->name('admin.area.create');
    Route::post('/area/store', [AreaController::class,'store'])
        ->name('admin.area.store');
    Route::get('/area/edit/{id}', [AreaController::class,'edit'])
        ->name('admin.area.edit');
    Route::post('/area/update/{id}', [AreaController::class,'update'])
        ->name('admin.area.update');

    // MEJA
    Route::get('/meja',
        [App\Http\Controllers\Admin\MejaController::class,'index'])
        ->name('admin.meja');

    Route::post('/meja',
        [App\Http\Controllers\Admin\MejaController::class,'store'])
        ->name('admin.meja.store');

    Route::delete('/meja/{id}',
        [App\Http\Controllers\Admin\MejaController::class,'destroy'])
        ->name('admin.meja.destroy');

    Route::get('/meja/edit/{id}', [MejaController::class,'edit'])
        ->name('admin.meja.edit');

    Route::post('/meja/update/{id}', [MejaController::class,'update'])
        ->name('admin.meja.update');
    
    Route::get('/meja/create', [MejaController::class,'create'])
        ->name('admin.meja.create');

    Route::post('/meja/store', [MejaController::class,'store'])
        ->name('admin.meja.store');

    // MENU
    Route::get('/menu',
        [MenuAdminController::class, 'index'])
        ->name('admin.menu');

    Route::get('/menu/create',
        [MenuAdminController::class, 'create'])
        ->name('admin.menu.create');

    Route::post('/menu',
        [MenuAdminController::class, 'store'])
        ->name('admin.menu.store');

    Route::get('/menu/{id}/edit',
        [MenuAdminController::class, 'edit'])
        ->name('admin.menu.edit');

    Route::put('/menu/{id}',
        [MenuAdminController::class, 'update'])
        ->name('admin.menu.update');

    Route::delete('/menu/{id}',
        [MenuAdminController::class, 'destroy'])
        ->name('admin.menu.destroy');
    
    Route::patch('/menu/{id}/toggle', [MenuAdminController::class, 'toggle'])
    ->name('admin.menu.toggle');


    // GALERI
    Route::get('/galeri',
        [GaleriAdminController::class, 'index'])
        ->name('admin.galeri');

    Route::get('/galeri/create',
        [GaleriAdminController::class, 'create'])
        ->name('admin.galeri.create');

    Route::post('/galeri',
        [GaleriAdminController::class, 'store'])
        ->name('admin.galeri.store');

    Route::delete('/galeri/{id}',
        [GaleriAdminController::class, 'destroy'])
        ->name('admin.galeri.destroy');

    // PELANGGAN
    Route::get('/pelanggan', [PelangganController::class, 'index'])
        ->name('admin.pelanggan.index');
    Route::get('/pelanggan/{id}', [PelangganController::class, 'show'])
        ->name('admin.pelanggan.show');

    // SETTING
    Route::get('/setting', [SettingController::class, 'index'])
        ->name('admin.setting.index');
    Route::post('/setting', [SettingController::class, 'update'])
        ->name('admin.setting.update');
    
    // NOTIFIKASI
    Route::get('/notifikasi', function () {

        $data = \App\Models\Reservasi::where('notif_dibaca',false)
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'count' => $data->count(),
            'data'  => $data
        ]);

    })->name('admin.notifikasi');

    Route::post('/notifikasi/read/{id}', function($id){

        \App\Models\Reservasi::where('id_reservasi',$id)
            ->update(['notif_dibaca'=>true]);

        return response()->json(['success'=>true]);

    })->name('admin.notifikasi.read');

});

Route::prefix('admin')->group(function () {

    Route::get('/login',
        [AuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login',
        [AuthController::class, 'login']);

    Route::post('/logout',
        [AuthController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/forgot-password',
        [AuthController::class, 'showForgotForm'])
        ->name('admin.password.request');

    Route::post('/forgot-password',
        [AuthController::class, 'resetDirectPassword'])
        ->name('admin.password.update');
});

Route::get('/admin/reservasi/json',
[ReservasiAdminController::class,'getJson'])
->name('admin.reservasi.json');

Route::get('/', function () {

    $menus = Menu::take(6)->get();
    $galeris = Galeri::latest()->get();

    return view('home', compact('menus', 'galeris'));
});

