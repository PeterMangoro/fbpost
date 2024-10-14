<?php

namespace App\Console\Commands;

use App\Models\FbPage;
use App\Models\Post;
use App\Services\Facebook\FbHandle;
use Illuminate\Console\Command;

class FbPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:post';

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
        $fb_page= FbPage::latest()->first();

        FbHandle::post($fb_page, $post);
        $this->info('fb-post posted successfully!');
    }
}
