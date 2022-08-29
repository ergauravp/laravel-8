<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPosts;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_blog_posts_page_record_is_added()
    {
        
        $post = $this->CreateDummyBlogPost();
        
        $response = $this->get('/posts');

        $response->assertSeeText('test title 7');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'test title 7'
        ]);

    }

    public function test_store_valid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post created successfully.');

    }

    public function test_store_failours()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');

    }

    public function test_update_valid()
    {
        $post = $this->CreateDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray()); 
        
        $params = [
            'title' => 'test title 7 updated',
            'content' => 'test content 7 updated'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status'); 
            
        $this->assertEquals(session('status'), 'Blog post updated.');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'test title 7 updated',
        ]);

    }    


    public function test_delete()
    {
        $post = $this->CreateDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status'); 
            
        $this->assertEquals(session('status'), 'Blog post deleted.');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());

    }    

    private function CreateDummyBlogPost(): BlogPosts
    {
        $post = new BlogPosts();
        $post->title = 'test title 7';
        $post->content = 'test content 7';
        $post->save();
        return $post;
    }

}
