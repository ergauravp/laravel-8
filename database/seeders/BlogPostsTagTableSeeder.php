<?php

namespace Database\Seeders;

use App\Models\BlogPosts;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostsTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if($tagCount === 0){
            $this->command->info("No tags found, skipping assigning tags to blog posts.");
            return;
        }

        $howManyMin = (int)$this->command->ask('Minimum tags on blog post?', 0);
        $howManyMax = min((int)$this->command->ask('Maximum tags on blog post?', $tagCount), $tagCount);

        BlogPosts::all()->each(function(BlogPosts $post) use($howManyMin, $howManyMax){
            $take = random_int($howManyMin, $howManyMax);
            $tages = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tages);
        });

    }
}
