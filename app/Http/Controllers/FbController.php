<?php

namespace App\Http\Controllers;

use App\Models\FbPage;
use App\Models\FbUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use JoelButcher\Facebook\Facades\Facebook as FacebookFacade;
use JoelButcher\Facebook\Facebook;

class FbController extends Controller
{
    public function login(){

        $scopes = ['pages_manage_posts', 'pages_read_engagement', 'pages_show_list'];

        $loginUrl = FacebookFacade::getRedirect(route('facebook.callback'), $scopes);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    public function callback(){

        $token = FacebookFacade::getToken();

        $fb = app(Facebook::class);
        $fb->getFacebook()->setDefaultAccessToken($token);

        $user=$fb->getUser();

        FbUser::updateOrCreate(
            ['fb_id' => $user->getId()],
            ['name'=>$user->getName(),
            'token' => $token,]
        );
$currentUser = FbUser::whereFbId($user->getId())->first();
        $pages_response = Http::baseUrl('https://graph.facebook.com')
            ->get('/me/accounts?access_token=' . $token)
            ->throw()
            ->json();

        foreach ($pages_response['data'] as $page) {
                FbPage::updateOrCreate(
                ['page_id' => $page['id'],'fb_user_id'=>$currentUser->id],
                [
                    'access_token' => $page['access_token'],
                    'category' => $page['category'],
                    'name' => $page['name'],
                ]
            );
        }

        return to_route('facebook.pages');
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
        return view('create-post',[
            'page' => $fb_page,
        ]);
    }

    public function pagePost($page, Request $request){
        $fb_page= FbPage::wherePageId($page)->first();

       Http::baseUrl('https://graph.facebook.com')
            ->post('/'.$fb_page->page_id.'/feed?access_token=' . $fb_page->access_token, [
                'message' => $request->message,
                'link' => $request->link,
            ])
            ->throw()
            ->json();

        return back()->with('status', 'Page Post created successfully');
    }

}
