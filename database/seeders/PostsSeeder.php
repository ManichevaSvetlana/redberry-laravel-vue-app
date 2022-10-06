<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        User::factory()
            ->count(10)
            ->create();

        $ids = User::pluck('id');

        for($i = 0; $i < 50; $i++)
        {
            $post = Post::create(['title' => $faker->realText(25), 'body' => $faker->realText(250), 'user_id' => $ids[rand(0, (count($ids) - 1))]]);
            for($k = 0; $k < rand(0, 10); $k++)
            {
                $post->comments()->create([
                    'message' => $faker->realText(25),
                    'user_id' => $ids[rand(0, (count($ids) - 1))]
                ]);
            }
        }
    }
}
