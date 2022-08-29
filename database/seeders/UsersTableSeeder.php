<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $userCounts = max((int)$this->command->ask("How many users would you like?", 20),1);
        User::factory()->gauravpipaliya()->create();
        User::factory()->count($userCounts)->create();
        
    }
}
