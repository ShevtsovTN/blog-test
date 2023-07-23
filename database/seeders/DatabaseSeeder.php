<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $readers = User::factory(5)->create();

         $author = User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

        $posts = Post::factory(10)
            ->for($author, 'user')
            ->create([
                'status' => (bool)Post::STATUS_ACTIVE
            ]);

        foreach ($posts as $post) {
            Comment::factory()
                ->for($post, 'post')
                ->for($readers->random(), 'user')
                ->create();
        }
    }
}
