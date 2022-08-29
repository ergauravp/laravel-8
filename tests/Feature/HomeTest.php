<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_is_working_properly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Home Page - Laravel App');
        $response->assertSeeText('Hello World');

    }

    public function test_contact_page_is_working_properly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact Page - Laravel App');
        $response->assertSeeText('Contact Page');

    }

}
