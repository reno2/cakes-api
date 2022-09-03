<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentPost;
use App\Models\Post;
use Database\Factories\CommentFactory;
use Database\Factories\CommentPostFactory;
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
        // \App\Models\User::factory(10)->create();
        //Category::factory(5)->create();
        //Post::factory(50)->create();
        //Comment::factory(80)->create();
//        RoleSeeder::factory(1)->creatte();
//        CommentPost::factory(80)->create();

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
        ]);

    }
}
