<?php

namespace App\Http\Controllers;

use \Datetime;
use \DateTimeZone;
use App\Mongo\Facade as Mongo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB;
use MongoDB\BSON\ObjectID;

class PostsController extends Controller
{
    //

    public function create () {
        return view('post_create');
    }

    public function store (Request $request) {
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
    }

    public function edit ($id) {
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
    }

    public function doEdit ($id, Request $request) {
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
    }

    public function destroy ($id) {
        return view('post_destroy', [
            'id' => $id,
        ]);
    }

    public function doDestroy ($id) {
        $collection = Mongo::get()->homestead->posts;
    
        $collection->deleteOne([
            '_id' => new ObjectID($id),
        ]);
    
        return redirect()->route('dashboard');
    }

    public function show ($id) {
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
    }
    
}
