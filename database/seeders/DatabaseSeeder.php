<?php

namespace Database\Seeders;

use App\Entity\Categories\Category;
use App\Entity\Users\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();
         Category::factory(10)->has(Category::factory()->count(3), 'children')->create();
    }
}
