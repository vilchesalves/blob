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

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('post/create', function () {
        return view('post_create');
    })->name('post.create');
    
    Route::post('post', function (Request $request) {
        $collection = Mongo::get()->homestead->posts;

        $date = new DateTime(
            $request->date . ' ' . $request->time,
            new DateTimeZone('Pacific/Auckland')
        );
    
        $insertOneResult = $collection->insertOne([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'date' => new MongoDB\BSON\UTCDateTime($date->getTimestamp() * 1000),
            'author' => $request->author,
        ]);
    
        $id = $insertOneResult->getInsertedId();
    
        return redirect()->route('post.show', [
            'id' => $id,
        ]);
    })->name('post.store');

    Route::get('post/{id}/edit', function ($id) {
        $collection = Mongo::get()->homestead->posts;
    
        $post = $collection->findOne([
            '_id' => new ObjectID($id),
        ]);
    
        if ($post === null) {
            abort(404);
        }

        $post->date = Carbon::instance($post->date->toDateTime())
            ->setTimeZone('Pacific/Auckland');
    
        return view('post_edit', [
            'post' => $post,
        ]);
    })->name('post.edit');

    Route::put('post/{id}/edit', function ($id, Request $request) {
        $collection = Mongo::get()->homestead->posts;

        $date = new DateTime(
            $request->date . ' ' . $request->time,
            new DateTimeZone('Pacific/Auckland')
        );

        $updateResult = $collection->updateOne(
            [
                '_id' => new ObjectID($id),
            ],
            [
                '$set' => [
                    'title' => $request->title,
                    'slug' => str_slug($request->title),
                    'body' => $request->body,
                    'date' => new MongoDB\BSON\UTCDateTime($date->getTimestamp() * 1000),
                    'author' => $request->author,
                ]
            ]
        );
        
        return redirect()->route('post.show', [
            'id' => $id,
        ]);
    })->name('post.edit');

    Route::get('post/{id}/destroy', function ($id) {
        return view('post_destroy', [
            'id' => $id,
        ]);
    })->name('post.destroy');
    
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

    $post->date = Carbon::instance($post->date->toDateTime())
        ->setTimeZone('Pacific/Auckland');
        
    return view('post_show', [
        'post' => $post,
    ]);
})->name('post.show');
