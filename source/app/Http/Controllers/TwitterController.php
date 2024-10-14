<?php

namespace App\Http\Controllers;

use App\Services\Twitter\Oauth;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function create()
    {
        return view('create-twitter-post');
    }
    public function post(Request $request){

        (new Oauth())->tweet($request->message);
        return back()->with('status', 'Page Post created successfully');
    }
}
