<?php

namespace App\Jobs;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $postId;
    public $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($postId, $path)
    {
        $this->postId = $postId;
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post = Post::find($this->postId);
        $image = new Image();
        /** @var UploadedFile $file */
        $img = \Intervention\Image\Facades\Image::make(Storage::path($this->path));
        $img = $img->greyscale();
        $img->save(Storage::path($this->path));
        $image->path = Storage::url($this->path);
        $image->post()->associate($post);
        $image->save();

    }
}
