<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FollowMasterController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\EnquireController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;


Route::get('loginin', function () {
    return view('admin.login2');
})->name('login');

Route::get('/', [Controller::class, 'dashboard'])->name('/');


Route::get('log-in', function() { return view('admin.login'); })->name('admin.login');

Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'AdminAuth'], function () {
    Route::get('/', [Controller::class,'admin_dashboard'])->name('dashboard');
    Route::resource('agent',AgentController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('follow-up-master',FollowMasterController::class);
    Route::resource('follow-up',FollowUpController::class);
    Route::resource('products',ProductController::class);
    Route::resource('companies',CompanyController::class);
    Route::resource('enquire',EnquireController::class);
    Route::post('orders-tracking', [OrderController::class, 'update_tracking_id'])->name('orders.tracking_update');
    Route::post('changeStatus', [OrderController::class, 'change_status'])->name('orders.changeStatus');
    Route::get('enquires-follow-ups', [EnquireController::class, 'enquires_follow_list'])->name('enquire.follows_ups');
    Route::get('follow-up-detail/{id}', [FollowUpController::class, 'show_detail'])->name('follow-up.show-detail');
    Route::post('add-more', [FollowUpController::class, 'add_follow_up'])->name('follow-up.add-more');
    Route::post('add-followup', [EnquireController::class, 'add_follow_up'])->name('enquire.add-followup');
});

Route::get('login', function() { return view('admin.login2'); })->name('agent.login');

Route::group(['prefix' => 'agent', 'as' => 'agent.' ,'middleware'=>'AgentAuth'], function () {
    Route::get('/', [Controller::class,'agent_dashboard'])->name('dashboard');
    Route::resource('orders',OrderController::class);
    Route::resource('follow-up',FollowUpController::class);
    Route::resource('enquire',EnquireController::class);
    Route::get('follow-up-detail/{id}', [FollowUpController::class, 'show_detail'])->name('follow-up.show-detail');
    Route::get('enquires-follow-ups', [EnquireController::class, 'enquires_follow_list'])->name('enquire.follows_ups');
    Route::post('add-more', [FollowUpController::class, 'add_follow_up'])->name('follow-up.add-more');
    Route::post('add-followup', [EnquireController::class, 'add_follow_up'])->name('enquire.add-followup');
});


Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
