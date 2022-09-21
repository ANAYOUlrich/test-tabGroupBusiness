<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function (Request  $request) {
        if($request->user()->role->libelle==User::$ADMIN){
            return redirect()->intended(route('dashboard.admin'));
        }elseif ($request->user()->role->libelle==User::$EDITER) {
            return redirect()->intended(route('dashboard.editer'));
        }elseif ($request->user()->role->libelle==User::$UTILISATEUR) {
            return view('dashboard');
        }else{
            abort(403);
        }
    })->name('dashboard');

    // Route::view('/dashboard', 'dashboard')->middleware(['role:utilisateur']);
    Route::view('/admin-dashboard', 'dashboard-admin')->middleware(['role:admin'])->name('dashboard.admin');
    Route::view('/editer-dashboard', 'dashboard-editer')->middleware(['role:editer'])->name('dashboard.editer');

    Route::resource('permissions', PermissionController::class, ['as' => '']);
    Route::resource('roles', RoleController::class, ['as' => '']);
    Route::resource('users', UserController::class, ['as' => '']);
});

require __DIR__.'/auth.php';
