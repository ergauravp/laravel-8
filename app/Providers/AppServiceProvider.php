<?php

namespace App\Providers;

use App\Http\Resources\Comment as CommentResource;
use App\Http\ViewComposers\ActivityComposer;
use App\Models\BlogPosts;
use App\Models\Comment;
use App\Observers\BlogPostsObserver;
use App\Observers\CommentObserver;
use App\Services\Counter;
use App\Services\DummyCounter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component('components.card', 'card');
        Blade::component('components.tags', 'tags');
        Blade::component('components.errors', 'errors');
        Blade::component('components.comment-form', 'commentForm');
        Blade::component('components.comment-list', 'commentList');

        // view()->composer('*',ActivityComposer::class);
        view()->composer(['posts.index','posts.show'],ActivityComposer::class);

        BlogPosts::observe(BlogPostsObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton(Counter::class, function($app){
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT')
            );
        });

        $this->app->bind(
            'App\Contracts\CounterContract',
            Counter::class
        );

        //CommentResource::withoutWrapping();
        JsonResource::withoutWrapping();

        // $this->app->bind(
        //     'App\Contracts\CounterContract',
        //     DummyCounter::class
        // );

        // $this->app->when(Counter::class)
        // ->needs('$timeout')
        // ->give(env('COUNTER_TIMEOUT'));

    }
}
