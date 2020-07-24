<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('slug')->unique();
            $table->string('title')->unique();
            $table->string('display_title')->nullable();
            $table->text('body')->nullable();
            $table->string('layout')->nullable();
            $table->string('template')->nullable()->default('page');
            $table->boolean('active')->default(false);
            $table->boolean('show_on_menu')->default(true);
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
