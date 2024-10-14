<?php

namespace App\Services\Facebook;

use App\Models\FbPage;
use App\Models\FbUser;
use Exception;
use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use JoelButcher\Facebook\Facades\Facebook as FacebookFacade;
use JoelButcher\Facebook\Facebook;

class FbHandle
{

    public static function getPages(): void
    {
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
    }

    public static function post(object $fb_page,object $post): void{

        Http::baseUrl('https://graph.facebook.com')
            ->post('/'.$fb_page->page_id.'/feed?access_token=' . $fb_page->access_token, [
                'message' => $post->message,
                'link' => $post->link,
            ])
            ->throw()
            ->json();
    }
}
