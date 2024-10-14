<?php

namespace App\Services\Instagram;

use App\Models\FbPage;
use App\Models\FbUser;
use Illuminate\Support\Facades\Http;
use JoelButcher\Facebook\Facades\Facebook as FacebookFacade;
use JoelButcher\Facebook\Facebook;

class InstaHandle
{

    public static function post(object $fb_page,object $post): void{
        $access_token = $fb_page->access_token;
        $response = Http::withToken($access_token)->get("https://graph.facebook.com/v13.0/{$fb_page->page_id}?fields=instagram_business_account");

        $instagramAccountId = $response->json('instagram_business_account.id');

        $imageUrl = $post->link; // URL of the image

        $response = Http::withToken($access_token)->post("https://graph.facebook.com/v13.0/{$instagramAccountId}/media", [
            'image_url' => $imageUrl,
            'caption' => $post->message,
        ]);

        $creationId = $response->json('id'); // Media creation ID

        $response = Http::withToken($access_token)->post("https://graph.facebook.com/v13.0/{$instagramAccountId}/media_publish", [
            'creation_id' => $creationId,
        ]);


    }
}
