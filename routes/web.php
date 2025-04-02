<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BusinessController;
use App\Http\Controllers\Backend\BusinessDetailsController;

use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\DetailController;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');


// Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard'); 
    })->name('admin.dashboard');
});

// ==== Manage Home Page
Route::resource('home-page', HomeController::class);

// ==== Manage About Page
Route::resource('about', AboutController::class);

// ==== Manage Bussiness Master
Route::resource('business', BusinessController::class);

// ==== Manage Bussiness Details
Route::resource('details', BusinessDetailsController::class);




Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    
    Route::get('/', [HomePageController::class, 'index'])->name('home.page');
    Route::get('/about-us', [HomePageController::class, 'about'])->name('about.us');
    Route::get('/{slug}', [DetailController::class, 'details'])->name('display.detail');

});