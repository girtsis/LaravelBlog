<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ImportComics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:comics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts from xkcd.com';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $progress = $this->output->createProgressBar(2703);
        for($i = 1; $i<2703; $i++) {
            try {

            $progress->advance();
            if(Cache::has("comic:$i")){
                $body = Cache::get("comic:$i");
            } else {
                sleep(1);
                $response = Http::get("https://xkcd.com/$i/");
                $body = $response->body();
                Cache::put("comic:$i", $body, Carbon::now()->addMonth());
            }
            $crawler = new Crawler($body);
            $img = $crawler->filter('#comic img')->first();
            $post = new Post();
            $post->title= $img->attr('alt');
            $post->body = $img->attr('title');
            $post->user_id = 1;
            $post->save();
            $image = new Image();
            $image->path = $img->attr('src');
            $image->post()->associate($post);
            $image->save();

            } catch (\Exception $e){

            }

        }
        $progress->finish();
        return Command::SUCCESS;
    }
}
