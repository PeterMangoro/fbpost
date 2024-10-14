<?php

namespace App\Services\LinkedIn;

use Exception;
use \GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LinkedInHandle
{
    private Client $client;
    private mixed $options;

    public function __construct()
    {
        $this->options = config('services.linkedin');

        $this->client = new Client(['base_uri' => 'https://www.linkedin.com']);

    }

    public function getAccessToken(): void
    {
        try {
        $response = $this->client->request('POST', '/oauth/v2/accessToken', [
            'form_params' => [
                "grant_type" => "authorization_code",
                "code" => $_GET['code'],
                "redirect_uri" =>  $this->options['redirect_url'],
                "client_id" => $this->options['client_id'],
                "client_secret" => $this->options['client_secret'],
            ],
        ]);
        $data = json_decode($response->getBody()->getContents(), true);
        $access_token = $data['access_token']; // store this token somewhere
            updateEnv('LINKEDIN_TOKEN', '"'.$access_token.'"');

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getLinkedInProfileId(): void{
        $access_token = env("LINKEDIN_TOKEN");

        $client = new Client(['base_uri' => 'https://api.linkedin.com']);
        $response =  Http::withToken($access_token)->post('https://api.linkedin.com/v2/me',[
            "Authorization" => "Bearer " . $access_token,
        ]);

//            $client->request('GET', '/v2/me', [
//            'headers' => [
//                "Authorization" => "Bearer " . $access_token,
//            ],
//        ]);
//        $data = json_decode($response->getBody()->getContents(), true);
//        $linkedin_profile_id = $data['id']; // store this id somewhere

        dd($response);
        $userId = $response->json('id'); // Extracts the LinkedIn ID
        if (!$userId) {
            $response = Http::withToken($access_token)->get('https://api.linkedin.com/v2/organizationAcls', [
                'q' => 'roleAssignee',
                'role' => 'ADMIN'
            ]);
            $organizations = $response->json('elements');


            foreach ($organizations as $organization) {
                $organizationUrn = $organization['organization'];
                $userId = $organizationUrn;
            }
        }
            updateEnv('LINKEDIN_PROFILE_ID', $userId);



    }

    public function post(Request $request){

        $accessToken = env('LINKEDIN_TOKEN'); // Retrieved from OAuth process

        $response = Http::withToken($accessToken)->post('https://api.linkedin.com/v2/ugcPosts', [
            'author' => 'urn:li:person:'.env('LINKEDIN_PROFILE_ID'),
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => 'Check out this amazing website!',
                    ],
                    'shareMediaCategory' => 'ARTICLE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => $request->message,
                            ],
                            'originalUrl' => $request->link, // URL to be shared

                        ]
                    ]
                ]
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ]);

        if ($response->successful()) {
            echo "Post published successfully on LinkedIn!";
        } else {
            echo "Failed to publish post: " . $response->body();
        }
    }

    function updateEnv($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}
