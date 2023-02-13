<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PatientController;

use App\Http\Middleware\AdminAuthenticate;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'submit'])->name('admin.login.submit');
    Route::get('logout/', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::group([AdminAuthenticate::class], function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Site Settings Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('site-settings/manage-admin', 'App\Http\Controllers\Admin\AdminRolesController')->except([
            'show', 'destroy'
        ]);
        // Route::resource('site-settings/company-settings', 'Admin\Settings\CompanySettingController')->only([
        //     'index', 'edit', 'update'
        // ]);

        /*
        |--------------------------------------------------------------------------
        | Patients Routes
        |--------------------------------------------------------------------------
        */
        Route::get('manage-patients/patients', [PatientController::class, 'index'])->name('manage.patients');
        Route::get('manage-patients/create', [PatientController::class, 'create'])->name('patients.create');
        Route::post('manage-patients/store', [PatientController::class, 'store'])->name('patients.store');
        Route::get('manage-patients/edit/{id}', [PatientController::class, 'edit'])->name('patients.edit');
        Route::put('manage-patients/update/{id}', [PatientController::class, 'update'])->name('patients.update');

    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
