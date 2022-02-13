<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Admin\Blog\BlogController;
use App\Http\Controllers\API\Admin\Skill\SkillController;
use App\Http\Controllers\Api\Frontend\FrontendController;
use App\Http\Controllers\API\Admin\Banner\BannerController;
use App\Http\Controllers\API\Admin\Setting\SettingController;
use App\Http\Controllers\API\Admin\Portfolio\PortfolioController;
use App\Http\Controllers\Api\Admin\Profile\UserController as ProfileUserController;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('add', [BookController::class, 'add']);
    Route::get('edit/{id}', [BookController::class, 'edit']);
    Route::post('update/{id}', [BookController::class, 'update']);
    Route::delete('delete/{id}', [BookController::class, 'delete']);
});

Route::group(['prefix'=>'v1'], function(){
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::patch('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');


        // FOR BANNER
        Route::apiResource('banner', BannerController::class);
        Route::patch('/update-order/banner', [BannerController::class, 'updateOrder'])->name('update-order.banner');
        Route::apiResource('skill', SkillController::class);
        Route::patch('/update-order/skill', [SkillController::class, 'updateOrder'])->name('update-order.skill');
        Route::apiResource('portfolio', PortfolioController::class);
        Route::patch('/update-order/portfolio', [PortfolioController::class, 'updateOrder'])->name('update-order.portfolio');
        Route::apiResource('blog', BlogController::class);
        Route::patch('/update-order/blog', [BlogController::class, 'updateOrder'])->name('update-order.blog');


        Route::get('/profile', [ProfileUserController::class, 'getUser'])->name('getUser');
        Route::post('/profile/image/{user}', [ProfileUserController::class, 'uploadProfile'])->name('uploadProfile');
        Route::patch('/profile/name/{user}', [ProfileUserController::class, 'updateName'])->name('updateName');
        Route::patch('/profile/email/{user}', [ProfileUserController::class, 'updateEmail'])->name('updateEmail');
        Route::patch('/profile/contact/{user}', [ProfileUserController::class, 'updateContact'])->name('updateContact');
        Route::patch('/profile/designation/{user}', [ProfileUserController::class, 'updateDesignation'])->name('updateDesignation');
        Route::patch('/profile/about/{user}', [ProfileUserController::class, 'updateAbout'])->name('updateAbout');
    }); 

});

Route::get('/skills',function(){
    return "Hello";
});
