<?php

namespace App\Http\Controllers;

use App\Models\FbPage;
use App\Models\FbUser;
use App\Services\Instagram\InstaHandle;
use Illuminate\Http\Request;

class InstaController extends Controller
{
    public function login(){
        echo to_route('facebook.login');
    }

    public function create($page){

        $fb_page= FbPage::wherePageId($page)->first();
        return view('create-instagram-post',[
            'page' => $fb_page,
        ]);
    }

    public function pagePost($page, Request $request){
        $fb_page= FbPage::wherePageId($page)->first();
        InstaHandle::post($fb_page, $request);
        return back()->with('status', 'Page Post created successfully');
    }
}
