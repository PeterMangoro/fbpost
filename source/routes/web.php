<?php

use App\Http\Controllers\FbController;
use App\Http\Controllers\InstaController;
use App\Http\Controllers\LinkedInController;
use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(FbController::class)->group(function(){
    Route::get('login','login')->name('facebook.login');
    Route::get('callback','callback')->name('facebook.callback');
    Route::get('pages','pages')->name('facebook.pages');
    Route::get('pages/create-post/{page}','create')->name('facebook.create');
    Route::post('pages/{page}','pagePost')->name('facebook.pagePost');
});

Route::controller(TwitterController::class)->group(function(){
   Route::get('twitter/create','create')->name('twitter.create');
    Route::post('twitter/post','post')->name('twitter.post');
});

Route::controller(LinkedInController::class)->group(function(){
    Route::get('linkedin/login','login')->name('linkedin.login');
    Route::get('linkedin_redirect','callback')->name('linkedin.callback');
    Route::get('linkedin/create','create')->name('linkedin.create');
    Route::post('linkedin/post','post')->name('linkedin.post');
});

Route::controller(InstaController::class)->group(function(){
    Route::get('instagram/login','login')->name('instagram.login');
    Route::get('instagram/callback','callback')->name('instagram.callback');
    Route::get('instagram/pages','pages')->name('instagram.pages');
    Route::get('instagram/pages/create-post/{page}','create')->name('instagram.create');
    Route::post('instagram/pages/{page}','pagePost')->name('instagram.post');
});
