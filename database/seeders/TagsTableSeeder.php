<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Science', 'Sport', 'Politics', 'Entartainment', 'Economy']);

        $tags->each(function($tagname){
            $tag = new Tag();
            $tag->name = $tagname;
            $tag->save();
        });
    }
}
