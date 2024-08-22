<?php

use App\Http\Controllers\FbController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('facebook.login');
});

Route::controller(FbController::class)->prefix('facebook')->group(function(){
    Route::get('login','login')->name('facebook.login');
    Route::get('callback','callback')->name('facebook.callback');
    Route::get('pages','pages')->name('facebook.pages');
    Route::get('pages/create-post/{page}','create')->name('facebook.create');
    Route::post('pages/{page}','pagePost')->name('facebook.pagePost');
});
