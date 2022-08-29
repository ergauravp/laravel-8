<?php

namespace App\Observers;

use App\Models\BlogPosts;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        // dd("I'm created");
        if($comment->commentable_type === BlogPosts::class){
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
            Cache::tags(['blog-post'])->forget("blog-posts-most-commented");
        }
    }

}
