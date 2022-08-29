<?php

namespace App\Listeners;

use App\Events\BlogPostsPosted;
use App\Jobs\ThrottleMail;
use App\Mail\BlogPostsAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminWhenBlogPostsCreated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostsPosted $event)
    {
        User::thatIsAnAdmin()->get()
        ->map(function(User $user){
            ThrottleMail::dispatch(
                new BlogPostsAdded(),
                $user
            );
        });
    }
}
