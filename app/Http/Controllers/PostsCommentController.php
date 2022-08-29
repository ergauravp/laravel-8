<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Http\Requests\StoreComment;
use App\Models\BlogPosts;
use App\Http\Resources\Comment as CommentResource;

class PostsCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index(BlogPosts $post)
    {
        return CommentResource::collection($post->comments()->with('user')->get());
        // return $post->comments()->with('user')->get();
    }

    public function store(BlogPosts $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        // Mail::to($post->user)->send(
        //     new CommentPostedMarkDown($comment)
        // );

        // $when = now()->addMinutes(1);

        // Mail::to($post->user)->queue(
        //     new CommentPostedMarkDown($comment)
        // );

        event(new CommentPosted($comment));


        // Mail::to($post->user)->later($when,
        //     new CommentPostedMarkDown($comment)
        // );

        return redirect()->back()->withStatus('Comment was created successfully.');

    }
}
