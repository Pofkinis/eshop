<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index');

Route::resource('phones', 'PhonesController');

Route::get('/phone/{id}', 'PhonesController@show') -> name('phoneDetails');

Route::get('/yourPhones', 'PhonesController@index')->name('userHome')->middleware('auth');

Route::get('/create/{id}', 'PhonesController@create')->name('phone-create')->middleware('auth');

Route::get('/phones/{{ $phone->id }}/edit', 'PhonesController@edit')->name('edit')->middleware('auth');

Route::get('/search', 'PhonesController@search')->name('search');

Route::get('/cheapests', 'PhonesController@cheapests')->name('cheapests');

Route::get('/forGaming', 'PhonesController@forGaming')->name('forGaming');

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('povkab@gmail.com')->send(new \App\Mail\MyTestMail($details));

    dd("Email is Sent.");
});
