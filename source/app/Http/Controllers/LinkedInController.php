<?php

namespace App\Http\Controllers;

use App\Services\LinkedIn\LinkedInHandle;
use Illuminate\Http\Request;

class LinkedInController extends Controller
{
    public function login(){

        $loginUrl = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=".config('services.linkedin.client_id')."&redirect_uri=".config('services.linkedin.redirect_url')."&scope=w_member_social";

        echo '<a href="' . $loginUrl . '">Log in with LinkedIn</a>';
    }

    public function callback(){

        (new LinkedInHandle())->getAccessToken();
        (new LinkedInHandle())->getLinkedInProfileId();
        return to_route('linkedin.create');
    }

    public function create()
    {
        return view('create-linkedin-post');
    }

    public function post(Request $request){

        (new LinkedInHandle())->post($request);
        return back()->with('status', 'Page Post created successfully');
    }
}
