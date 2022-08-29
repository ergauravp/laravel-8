<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use HasFactory;
use App\Models\Profile;
use App\Models\Author;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Author $author) {
            $author->profile()->save(Profile::factory()->make());
        });
    }
    

}
