<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottleMail;
use App\Mail\CommentPostedMarkDown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAboutComment
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        // dd("I was calling in response to an event.");
        ThrottleMail::dispatch(
            new CommentPostedMarkDown($event->comment), 
            $event->comment->commentable->user
        )->onQueue('low');

        NotifyUsersPostWasCommented::dispatch(
            $event->comment
        )->onQueue('high');
    }
}
