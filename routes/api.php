<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    echo 'API is actived!';
});

Route::get('homepage_carousels', 'HomepageCarouselController@get');
Route::get('partners', 'PartnerController@get');

Route::group(['prefix' => 'expert'], function () {
    Route::get('/', 'ExpertController@search');
    Route::get('/{id}', 'ExpertController@find');
    Route::post('/contact', 'ExpertController@contact');
});

Route::group(['prefix' => 'project'], function () {
    Route::get('/', 'ProjectController@search');
    Route::get('/{id}', 'ProjectController@find');
});

Route::group(['prefix' => 'sdgs'], function () {
    Route::get('/', 'SustainableDevelopmentGoalController@search');
    Route::get('/{code}', 'SustainableDevelopmentGoalController@findByCode');
});

Route::group(['prefix' => 'epaper'], function () {
    Route::post('/subscription', 'EpaperController@subscription');
});
