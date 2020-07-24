<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Flowcms\Flowcms\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::firstOrNew([
            'title' => $title = 'How to create a Page with FlowCMS?',
            'slug' => Str::slug($title),
        ], [
            'uuid' => Str::uuid(),
            'category_id' => 1,
            'user_id' => 1,
            'body' => 'What is FlowCMS? It is a simple content management build for rapid prototyping websites. It is built for developers for running blogs, landing pages, use as starter admin panel and many more. It is built with Laravel, AlpineJS and TailwindCSS. We’ve designed everything to make development easier and many new features on the lists. Get up and running in no time.',
            'publish_date' => now(),
        ]);

        // $data = File::get("database/articles.html");

        // dd($data);

        // foreach (range(0, 50) as $obj) {
        //     $title = $faker->sentence(4);

        // 	Article::create([
        //         'uuid' =>Str::uuid(),
        //         'category_id' => 1,
        //         'user_id' => 1,
        //         'title' => $title,
        //         'slug' => Str::slug($title),
        //         'body' => $data,
        //         'publish_date' => $faker->dateTime(),
        // 	]);
        // }

    }
}
