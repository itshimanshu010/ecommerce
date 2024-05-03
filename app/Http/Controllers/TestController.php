<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

private $database;

public function __construct()
{
    $this->database = \App\Services\FirebaseService::connect();
}

class TestController extends Controller
{
    public function create(Request $request) 
    {
    $this->database
        ->getReference('test/blogs/' . $request['title'])
        ->set([
            'title' => $request['title'] ,
            'content' => $request['content']
        ]);

    return response()->json('blog has been created');
    }

    public function index() 
    {
    return response()->json($this->database->getReference('test/blogs')->getValue());
    }
}
