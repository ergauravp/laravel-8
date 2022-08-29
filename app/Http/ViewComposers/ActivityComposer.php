<?php 

namespace App\Http\ViewComposers;

use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

Class ActivityComposer
{

    public function compose(View $view)
    {

        $mostCommented = Cache::tags(['blog-post'])->remember('blog-posts-most-commented',60, function(){
            return BlogPosts::mostCommented()->take(5)->get();
        });

        $mostActive = Cache::remember('users-most-active',60, function(){
            return User::withMostBlogPosts()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('users-most-active-last-month',60, function(){
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);

    }

}

