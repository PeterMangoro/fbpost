<?php

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

final class Oauth
{
    private TwitterOAuth $client;

    public function __construct()
    {
        $options = config('services.twitter');

        $this->client = new TwitterOAuth(
            $options['consumer_key'],
            $options['consumer_secret'],
            $options['access_token'],
            $options['access_secret']
        );

        $this->client->setApiVersion('2');
    }

    public function tweet(string $message): void
    {
        $this->client->post('tweets', ['text' => $message]);
    }
}
