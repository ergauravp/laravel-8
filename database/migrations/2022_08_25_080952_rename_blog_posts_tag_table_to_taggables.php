<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBlogPostsTagTableToTaggables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts_tag', function (Blueprint $table) {
            $table->dropForeign(['blog_posts_id']);
            $table->dropColumn('blog_posts_id');
        });

        Schema::rename('blog_posts_tag', 'taggables');

        Schema::table('taggables', function (Blueprint $table) {
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropMorphs('taggable');
        });

        Schema::rename('taggables', 'blog_posts_tag');

        Schema::disableForeignKeyConstraints();

        Schema::table('blog_posts_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_posts_id')->index();
            $table->foreign('blog_posts_id')
                ->references('id')
                ->on('blog_posts')
                ->onDelete('cascade');
        });        

        Schema::enableForeignKeyConstraints();
    }
}
