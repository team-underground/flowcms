<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Flowcms\Flowcms\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrNew([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized'
        ], [
            'uuid' => Str::uuid(),
        ]);
    }
}
