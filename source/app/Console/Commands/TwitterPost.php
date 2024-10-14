<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\Twitter\Oauth;
use Illuminate\Console\Command;

class TwitterPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post = Post::latest()->first();
        $message = $post->message." @ ".$post->link;
        (new Oauth())->tweet($message);
        $this->info('twitter-post posted successfully!');
    }
}
