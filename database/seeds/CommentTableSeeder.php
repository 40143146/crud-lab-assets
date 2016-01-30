<?php

use App\Comment;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();

        $faker = Faker::create('zh_TW');

        foreach(range(1, 20) as $id) {
            Comment::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'content' => $faker->paragraph,
                'post_id' => rand(1, 20),
                'created_at' => Carbon::now()->subDays(20 - $id),
                'updated_at' => Carbon::now()->subDays(20 - $id),
            ]);
        }
    }
}
