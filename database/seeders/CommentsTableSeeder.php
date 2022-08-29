<?php

namespace Database\Seeders;

use App\Models\BlogPosts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = BlogPosts::all();

        $users = User::all();        
        
        if($posts->count() === 0 || $users->count() === 0){
            $this->command->info('There are no blog posts or users, so no comments will be added');
            return;
        }

        $commentsCounts = (int)$this->command->ask("How many comments would you like?", 150);       
        
        Comment::factory()->count($commentsCounts)->make()->each(function($comment) use ($posts, $users){
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\Models\BlogPosts';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
        
        Comment::factory()->count($commentsCounts)->make()->each(function($comment) use ($users){
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\Models\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });        

    }
}
