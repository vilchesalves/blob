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

use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    $posts = Mongo::get()->homestead->posts->find()->toArray();

    foreach ($posts as $post) {
        $post->date = Carbon::instance($post->date->toDateTime())
            ->setTimeZone('Pacific/Auckland');
    }

    return view('index', [
        'posts' => $posts,
    ]);
})->name('index');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('post/create', 'PostsController@create')->name('post.create');
    Route::post('post', 'PostsController@store')->name('post.store');
    Route::get('post/{id}/edit', 'PostsController@edit')->name('post.edit');
    Route::put('post/{id}/edit', 'PostsController@doEdit')->name('post.edit');
    Route::get('post/{id}/destroy', 'PostsController@destroy')->name('post.destroy');
    Route::delete('post/{id}/destroy', 'PostsController@doDestroy')->name('post.destroy');
});

Route::get('post/{id}', 'PostsController@show')->name('post.show');
