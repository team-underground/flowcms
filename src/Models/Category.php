<?php

namespace Flowcms\Flowcms\Models;

use Flowcms\Flowcms\Models\Article;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'slug',
        'name',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $articles = Article::where('category_id', $category->id)->get();
            $articles->map(function ($item) {
                // delete article cache
                Cache::forget('articles-' . $item->slug);
            });

            Article::where('category_id', $category->id)->update(['category_id' => 1]);
        });
    }

    public function articles()
    {
        return $this->hasMany(\Flowcms\Flowcms\Models\Article::class);
    }
}
