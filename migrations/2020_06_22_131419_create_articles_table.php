<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title')->index();
            $table->text('body');
            $table->boolean('status')->default(true);
            $table->timestamp('publish_date')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
