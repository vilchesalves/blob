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

use Illuminate\Http\Request;

Route::get('mongo', function(Request $request) {
    $collection = Mongo::get()->homestead->posts;
    return $collection->find()->toArray();
});

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('post/create', function () {
    return view('post_create');
})->name('post.create');

Route::post('post/store', function (Request $request) {
    $collection = Mongo::get()->homestead->posts;

    $insertOneResult = $collection->insertOne([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    $id = $insertOneResult->getInsertedId();

    return redirect()->route('post.view', [
        'id' => $id,
    ]);
});

Route::get('post/{id}', function ($id) {
    dd($id);
    return $id;
})->name('post.view');
