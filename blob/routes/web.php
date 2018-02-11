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
use MongoDB\BSON\ObjectID;

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    $posts = Mongo::get()->homestead->posts->find()->toArray();

    return view('index', [
        'posts' => $posts,
    ]);
})->name('index');

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('post/create', function () {
        return view('post_create');
    })->name('post.create');
    
    Route::post('post', function (Request $request) {
        $collection = Mongo::get()->homestead->posts;
    
        $insertOneResult = $collection->insertOne([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    
        $id = $insertOneResult->getInsertedId();
    
        return redirect()->route('post.show', [
            'id' => $id,
        ]);
    })->name('post.store');

    Route::get('post/{id}/destroy', function ($id) {
        return view('post_destroy', [
            'id' => $id,
        ]);
    })->name('post.confirm_destroy');
    
    Route::delete('post/{id}/destroy', function ($id) {
        $collection = Mongo::get()->homestead->posts;
    
        $collection->deleteOne([
            '_id' => new ObjectID($id),
        ]);
    
        return redirect()->route('dashboard');
    })->name('post.destroy');

});

Route::get('post/{id}', function ($id) {
    $collection = Mongo::get()->homestead->posts;

    $post = $collection->findOne([
        '_id' => new ObjectID($id),
    ]);

    if ($post === null) {
        abort(404);
    }

    return view('post_show', [
        'post' => $post,
    ]);
})->name('post.show');
