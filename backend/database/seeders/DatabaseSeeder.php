<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentPost;
use App\Models\Post;
use App\Models\Tag;
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
       // Tag::factory()->count(10)->create();

        // \App\Models\User::factory(10)->create();
        //Category::factory(10)->create();
       // Post::factory(10)->create();
        Article::factory(10)->create();
        //Comment::factory(80)->create();
//        RoleSeeder::factory(1)->creatte();
//        CommentPost::factory(80)->create();

//        $this->call([
           // TagSeeder::class
//            RoleSeeder::class,
//            CategorySeeder::class,
//        ]);

    }
}
