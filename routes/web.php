<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FollowMasterController;
use App\Http\Controllers\FollowUpController;


Route::get('loginin', function () {
    return view('admin.login2');
})->name('login');

Route::get('/', [Controller::class, 'dashboard'])->name('/');


Route::get('log-in', function() { return view('admin.login'); })->name('admin.login');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'AdminAuth'], function () {

    Route::resource('agent',AgentController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('follow-up-master',FollowMasterController::class);
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::post('orders-tracking', [OrderController::class, 'update_tracking_id'])->name('orders.tracking_update');
    Route::post('changeStatus', [OrderController::class, 'change_status'])->name('orders.changeStatus');

});

Route::get('login', function() { return view('admin.login2'); })->name('agent.login');

Route::group(['prefix' => 'agent', 'as' => 'agent.' ,'middleware'=>'AgentAuth'], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('orders',OrderController::class);
    Route::resource('follow-up',FollowUpController::class);
    Route::get('follow-up-detail/{id}', [FollowUpController::class, 'show_detail'])->name('follow-up.show-detail');
    Route::post('add-more', [FollowUpController::class, 'add_follow_up'])->name('follow-up.add-more');
});


Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
