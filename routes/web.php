<?php

use App\Http\Controllers\AccidentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SettingController;
use App\Models\Setting;

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
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        $setting = Setting::first();
        return view('admin.dashboard', ['setting' => $setting]);
    })->name('dashboard');
    
    Route::group(['prefix' => 'user'], function () {
        Route::get('', [UserController::class, 'index'])->name('user');        
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('{id}/', [UserController::class, 'show'])->name('user.show');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('{id}/delete', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('{id}/restore', [UserController::class, 'restore'])->name('user.restore');
        Route::post('{id}/resetpass', [UserController::class, 'resetpass'])->name('user.resetpass');
        Route::post('search', [UserController::class, 'search'])->name('user.search');
    });

    Route::group(['prefix' => 'center'], function () {
        Route::get('', [CenterController::class, 'index'])->name('center');        
        Route::get('create', [CenterController::class, 'create'])->name('center.create');
        Route::post('store', [CenterController::class, 'store'])->name('center.store');
        Route::get('{id}/', [CenterController::class, 'show'])->name('center.show');
        Route::get('{id}/edit', [CenterController::class, 'edit'])->name('center.edit');
        Route::post('{id}/update', [CenterController::class, 'update'])->name('center.update');
        Route::get('{id}/delete', [CenterController::class, 'destroy'])->name('center.delete');
        Route::get('{id}/restore', [CenterController::class, 'restore'])->name('center.restore');
        Route::post('search', [CenterController::class, 'search'])->name('center.search');
    });

    Route::group(['prefix' => 'store'], function () {
        Route::get('', [StoreController::class, 'index'])->name('store');        
        Route::get('create', [StoreController::class, 'create'])->name('store.create');
        Route::post('store', [StoreController::class, 'store'])->name('store.store');
        Route::get('{id}/', [StoreController::class, 'show'])->name('store.show');
        Route::get('{id}/edit', [StoreController::class, 'edit'])->name('store.edit');
        Route::post('{id}/update', [StoreController::class, 'update'])->name('store.update');
        Route::get('{id}/delete', [StoreController::class, 'destroy'])->name('store.delete');
        Route::get('{id}/restore', [StoreController::class, 'restore'])->name('store.restore');
        Route::post('search', [StoreController::class, 'search'])->name('store.search');
    });

    Route::group(['prefix' => 'route'], function () {
        Route::get('', [RouteController::class, 'index'])->name('route');        
        Route::get('create', [RouteController::class, 'create'])->name('route.create');
        Route::post('store', [RouteController::class, 'store'])->name('route.store');
        Route::get('{id}/', [RouteController::class, 'show'])->name('route.show');
        Route::get('{id}/edit', [RouteController::class, 'edit'])->name('route.edit');
        Route::post('{id}/update', [RouteController::class, 'update'])->name('route.update');
        Route::get('{id}/delete', [RouteController::class, 'destroy'])->name('route.delete');
        Route::get('{id}/restore', [RouteController::class, 'reroute'])->name('route.restore');
    });    


    Route::group(['prefix' => 'accident'], function () {
        Route::get('', [AccidentController::class, 'index'])->name('accident');
        Route::get('{id}/show', [AccidentController::class, 'show'])->name('accident.show');
        Route::get('{id}/edit', [AccidentController::class, 'edit'])->name('accident.edit');
        Route::post('search', [AccidentController::class, 'search'])->name('accident.search');
        Route::get('check', [AccidentController::class, 'check'])->name('accident.check');
        Route::get('create', [AccidentController::class, 'create'])->name('accident.create');
        Route::post('store', [AccidentController::class, 'store'])->name('accident.store');
        Route::get('{id}/delete', [AccidentController::class, 'destroy'])->name('accident.delete');
        Route::get('{id}/report', [AccidentController::class, 'report'])->name('accident.report');
        Route::post('{id}/update', [AccidentController::class, 'update'])->name('accident.update');
        Route::get('{id}/deleteCarImage', [AccidentController::class, 'deleteCarImage'])->name('accident.deleteCarImage');
        Route::get('{id}/deleteInsuranceImage', [AccidentController::class, 'deleteInsuranceImage'])->name('accident.deleteInsuranceImage');
        Route::get('{id}/deleteAccidentImage', [AccidentController::class, 'deleteAccidentImage'])->name('accident.deleteAccidentImage');
    });  

    Route::group(['prefix' => 'track'], function () {
        Route::get('', [TrackController::class, 'index'])->name('track');
        Route::get('{id}/show', [TrackController::class, 'show'])->name('track.show');
        Route::get('{id}/edit', [TrackController::class, 'edit'])->name('track.edit');
        Route::post('search', [TrackController::class, 'search'])->name('track.search');
        Route::get('create', [TrackController::class, 'create'])->name('track.create');
        Route::post('store', [TrackController::class, 'store'])->name('track.store');
        Route::get('{id}/delete', [TrackController::class, 'destroy'])->name('track.delete');
        Route::get('{id}/report', [TrackController::class, 'report'])->name('track.report');
        Route::post('{id}/update', [TrackController::class, 'update'])->name('track.update');
        Route::get('{id}/deletefile', [TrackController::class, 'deletefile'])->name('track.deletefile');
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('/slogan', [SettingController::class, 'sloganIndex'])->name('slogan.index');
        Route::post('/slogan/store', [SettingController::class, 'sloganStore'])->name('slogan.store');
        Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
        Route::post('/guide/store', [GuideController::class, 'store'])->name('guide.store');
    });
});

Route::prefix('staff')->middleware('auth')->group(function () {
    Route::get('', function () {
        $setting = Setting::first();
        return view('staff.dashboard', ['setting' => $setting]);        
    })->name('staff.dashboard');

    Route::group(['prefix' => 'route'], function () {
        Route::get('', [RouteController::class, 'search'])->name('staff.route.search');
        Route::post('result', [RouteController::class, 'result'])->name('staff.route.result');        
    });

    Route::group(['prefix' => 'store'], function () {        
        Route::get('', function () {
            return view('staff.store.search');   
        })->name('staff.store');    
        Route::get('{id}/show', [StoreController::class, 'show'])->name('staff.store.show');
        Route::get('{id}/edit', [StoreController::class, 'edit'])->name('staff.store.edit');
        Route::get('create', [StoreController::class, 'create'])->name('staff.store.create');
        Route::post('store', [StoreController::class, 'store'])->name('staff.store.store');
        Route::post('{id}/update', [StoreController::class, 'update'])->name('staff.store.update');
        Route::post('search', [StoreController::class, 'search'])->name('staff.store.search');
        Route::get('{id}/delete', [StoreController::class, 'destroy'])->name('staff.store.delete');
    });


    Route::group(['prefix' => 'accident'], function () {
        Route::get('', [AccidentController::class, 'index'])->name('staff.accident.index');
        Route::get('{id}/show', [AccidentController::class, 'show'])->name('staff.accident.show');
        Route::get('{id}/edit', [AccidentController::class, 'edit'])->name('staff.accident.edit');
        Route::post('search', [AccidentController::class, 'search'])->name('staff.accident.search');
        Route::get('check', [AccidentController::class, 'check'])->name('staff.accident.check');
        Route::get('create', [AccidentController::class, 'create'])->name('staff.accident.create');
        Route::post('store', [AccidentController::class, 'store'])->name('staff.accident.store');
        Route::get('{id}/delete', [AccidentController::class, 'destroy'])->name('staff.accident.delete');
        Route::get('{id}/report', [AccidentController::class, 'report'])->name('staff.accident.report');
        Route::post('{id}/update', [AccidentController::class, 'update'])->name('staff.accident.update');        
        Route::get('{id}/deleteImage', [AccidentController::class, 'deleteImage'])->name('staff.accident.deleteImage');
    });

    Route::group(['prefix' => 'track'], function () {
        Route::get('', [TrackController::class, 'index'])->name('staff.track.index');
        Route::get('{id}/show', [TrackController::class, 'show'])->name('staff.track.show');
        Route::get('{id}/edit', [TrackController::class, 'edit'])->name('staff.track.edit');
        Route::post('search', [TrackController::class, 'search'])->name('staff.track.search');
        Route::get('create', [TrackController::class, 'create'])->name('staff.track.create');
        Route::post('store', [TrackController::class, 'store'])->name('staff.track.store');
        Route::get('{id}/delete', [TrackController::class, 'destroy'])->name('staff.track.delete');
        Route::get('{id}/report', [TrackController::class, 'report'])->name('staff.track.report');
        Route::post('{id}/update', [TrackController::class, 'update'])->name('staff.track.update');
        Route::get('{id}/deletefile', [TrackController::class, 'deletefile'])->name('staff.track.deletefile');
    });

    Route::group(['prefix' => 'guide'], function () {
        Route::get('', [GuideController::class, 'index'])->name('staff.guide.index');
    });

});


Route::get('/', [UserController::class, 'index'])->middleware('auth');

// Route::get('/dashboard', function () {
//     retreurn view('admin.user.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});


// Route::get('logout', [UserController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
