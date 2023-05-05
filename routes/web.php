<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Controller;





Route::get('login', function () {
    return view('admin.login');
})->name('login');

Route::get('/', [Controller::class, 'dashboard'])->name('/');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('agent',AgentController::class);
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

});


Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
