<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReceipeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Kitchen\OrderController as KitchenOrderController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboardController;
use App\Http\Controllers\Waiter\OrderController as WaiterOrderController;
use App\Http\Livewire\Admin\Table\Index;

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

// All Users Routes
Route::prefix('users')->middleware(['auth'])->group(function(){
    Route::get('/profile',[UserProfileController::class,'index']);
    Route::post('/profile',[UserProfileController::class,'saveProfile']);
    Route::get('/change-password',[UserProfileController::class,'changePassword']);
    Route::post('/change-password',[UserProfileController::class,'updatePassword']);
    Route::get('/deleteProfileImage',[UserProfileController::class,'deleteProfileImage']);
});

// Admin Routes
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::resource('categories', CategoryController::class);
    Route::resource('receipes',ReceipeController::class);
    Route::resource('users',UserController::class);
    Route::get('/receipes/{receipe_image}/deleteReceipeImage',[ReceipeController::class,'deleteReceipeImage']);
    Route::get('/categories/{category}/deleteCategoryImage',[CategoryController::class,'deleteCategoryImage']);
    Route::get('/tables',Index::class);
    Route::get('/orders',[OrderController::class,'index']);
    Route::get('/order-details/{order_id}',[OrderController::class,'detail']);
});

// Waiter Routes
Route::prefix('waiter')->middleware(['auth','isWaiter'])->group(function(){
    Route::get('/dashboard',[WaiterDashboardController::class,'index']);
    Route::post('orderSubmit',[WaiterDashboardController::class,'saveOrder']);
    Route::get('/orders',[WaiterOrderController::class,'index']);
    Route::get('/serve/{order_item}',[WaiterOrderController::class,'serve']);
});

// Kitchen Routes
Route::prefix('kitchen')->middleware(['auth'])->group(function(){
    Route::get('/orders',[KitchenOrderController::class,'index']);
    Route::get('/pending/{order_item}',[KitchenOrderController::class,'pending']);
    Route::get('/cancel/{order_item}',[KitchenOrderController::class,'cancel']);
    Route::get('/ready/{order_item}',[KitchenOrderController::class,'ready']);
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
