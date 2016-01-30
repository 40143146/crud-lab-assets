<?php

use App\Post;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $faker = Faker::create('zh_TW');

        foreach(range(1, 20) as $id) {
            Post::create([
                'title' => $faker->sentence,
                'sub_title' => $faker->sentence,
                'content' => $faker->paragraph,
                'is_feature' => rand(0, 1),
                'page_view' => rand(0, 200),
                'created_at' => Carbon::now()->subDays(20 - $id),
                'updated_at' => Carbon::now()->subDays(20 - $id),
            ]);
        }
    }
}
