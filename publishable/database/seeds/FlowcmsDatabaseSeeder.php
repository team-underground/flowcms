<?php

use Illuminate\Database\Seeder;
use Flowcms\Flowcms\Traits\Seedable;

class FlowcmsDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('AdminUserSeeder');
        $this->seed('CategoryTableSeeder');
        $this->seed('ArticleTableSeeder');
    }
}
