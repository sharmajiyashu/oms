<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;


Route::get('login', function () {
    return view('admin.login2');
})->name('login');

Route::get('/', [Controller::class, 'dashboard'])->name('/');


Route::get('log-in', function() { return view('admin.login'); })->name('admin.login');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'AdminAuth'], function () {
    Route::resource('agent',AgentController::class);
    Route::resource('orders',OrderController::class);
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::get('login', function() { return view('admin.login2'); })->name('agent.login');

Route::group(['prefix' => 'agent', 'as' => 'agent.' ,'middleware'=>'AgentAuth'], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('orders',OrderController::class);
});


Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
