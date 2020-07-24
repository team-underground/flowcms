<?php

namespace Flowcms\Flowcms\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'slug',
        'title',
        'display_title',
        'body',
        'layout',
        'active',
        'show_on_menu',
        'template',
        'seo_title',
        'seo_description'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'show_on_menu' => 'boolean'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCacheOfPageMenu();
        });

        static::created(function () {
            self::flushCacheOfPageMenu();
        });

        static::deleted(function () {
            self::flushCacheOfPageMenu();
        });
    }

    /**
     * Flush the cache for Menus
     */
    public static function flushCacheOfPageMenu()
    {
        Cache::forget('pageForMenu');
    }

    public static function getPagesForMenu()
    {
        return Cache::rememberForever('pageForMenu', function () {
            return self::where('show_on_menu', true)->where('active', false)->select('active', 'slug', 'title')->get() ?? [];
        });
    }

    public function scopeIsActive()
    {
        $this->active === true;
    }

    public function scopeIsLanding()
    {
        $this->template === 'landing';
    }

    public function scopeIsNotActive()
    {
        $this->active === false;
    }

    public function blocks()
    {
        return $this->hasMany(\Flowcms\Flowcms\Models\Block::class);
    }
}
