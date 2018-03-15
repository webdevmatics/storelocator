<?php

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

use App\Shop;

Route::post('/nearest-shops', function () {
   $center=request('center');

    // Search the rows in the markers table
    $nearestShops=Shop::selectRaw("SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance")
        ->where('distance','<',25)->orderBy('distance');
   return response(request()->all());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
