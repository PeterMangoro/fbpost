<?php

namespace App\Console\Commands;

use App\Models\FbPage;
use App\Models\Post;
use App\Services\Instagram\InstaHandle;
use Illuminate\Console\Command;

class InstagramPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:post';

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
        InstaHandle::post($fb_page, $post);

        $this->info('instagram-post posted successfully!');
    }
}
