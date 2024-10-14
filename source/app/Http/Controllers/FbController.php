<?php

namespace App\Http\Controllers;

use App\Models\FbPage;
use App\Models\FbUser;
use App\Services\Facebook\FbHandle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use JoelButcher\Facebook\Facades\Facebook as FacebookFacade;
use JoelButcher\Facebook\Facebook;
use function Pest\Laravel\json;

class FbController extends Controller
{
    public function login(){

        $scopes = ['pages_manage_posts', 'pages_read_engagement', 'pages_show_list','instagram_basic','instagram_content_publish',];

        $loginUrl = FacebookFacade::getRedirect(route('facebook.callback'), $scopes);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    public function callback(){

       FbHandle::getPages();

        $user = FbUser::with('pages')->first();

        $pages=$user ->pages;

        return response()->json([
            'user' => $user,
            'pages' => $pages
        ]);

//        return to_route('facebook.pages');
    }

    public function pages():View
    {
        $user = FbUser::with('pages')->first();

        $pages=$user ->pages;
        return view('pages',[
            'pages' => $pages,
            'user' => $user->name,
                    ]);
    }

      public function create($page){

     $fb_page= FbPage::wherePageId($page)->first();
        return view('create-fb-post',[
            'page' => $fb_page,
        ]);
    }

    public function pagePost($page, Request $request){
        $fb_page= FbPage::wherePageId($page)->first();
        FbHandle::post($fb_page, $request);
        return back()->with('status', 'Page Post created successfully');
    }

}
