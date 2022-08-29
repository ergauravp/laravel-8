<?php

namespace App\Observers;

use App\Models\BlogPosts;
use Illuminate\Support\Facades\Cache;

class BlogPostsObserver
{


    public function updating(BlogPosts $blogPosts)
    {
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPosts->id}");
    }    

    public function deleting(BlogPosts $blogPosts)
    {
        // dd("I'm deleted");
        $blogPosts->comments()->delete();
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPosts->id}");
    }    

    public function restoring(BlogPosts $blogPosts)
    {
        $blogPosts->comments()->restore();
    }    

}
