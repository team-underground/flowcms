<?php

namespace Flowcms\Flowcms\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Article extends Model implements Viewable
{
    use InteractsWithViews;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'category_id',
        'user_id',
        'slug',
        'title',
        'body',
        'status',
        'publish_date',
        'image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $removeViewsOnDelete = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_date',
    ];

    protected $appends = [
        'published_date',
        'article_summary',
        'links',
        'images',
        'article_with_responsive_images'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });

        static::updating(function ($model) {
            // update cache content
            Cache::put('articles-' . $model->slug, $model);
        });

        static::deleting(function ($model) {
            // delete article cache
            Cache::forget('articles-' . $model->slug);
        });
    }

    public function getArticleStatusAttribute()
    {
        return $this->status == true ? 'Published' : 'Draft';
    }

    public function scopeIsPublished($query)
    {
        return $query->where('status', 1);
    }

    public function getArticleSummaryAttribute()
    {
        return Str::limit(strip_tags($this->body), 200);
    }

    public function getPublishedDateAttribute()
    {
        return $this->publish_date->format('d M Y');
    }

    public function getLinksAttribute()
    {
        return [
            'show' => route('flowcms::blog.show', $this->slug),
            'edit' => route('flowcms::articles.edit', $this),
            'delete' => route('flowcms::articles.destroy', $this),
        ];
    }

    public function getImagesAttribute()
    {
        if ($this->image === '') {
            return [];
        }

        $parsesUrl = parse_url($this->image);
        $imageSavedUrl = $parsesUrl['scheme'] . '://' . $parsesUrl['host'];
        $imageSavedSecureUrl = $parsesUrl['scheme'] . 's://' . $parsesUrl['host'];

        if (collect([$imageSavedUrl, $imageSavedSecureUrl])->contains(request()->root())) {
            $imageUrl = explode(config('app.url') . '/storage/', $this->image);

            return [
                'small' => url('/img/' . $imageUrl[1] . '?w=320'),
                'medium' => url('/img/' . $imageUrl[1] . '?w=640'),
                'large' => url('/img/' . $imageUrl[1] . '?w=1024')
                // 'xlarge' => url('/img/' . $imageUrl[1] .'?w=1200'),
            ];
        }

        return [
            'small' => '',
            'medium' => '',
            'large' => ''
        ];
    }

    public function getArticleWithResponsiveImagesAttribute()
    {
        $body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');

        $doc = new \DOMDocument();
        $doc->loadHTML($body);
        $tags = $doc->getElementsByTagName('img');

        foreach ($tags as $tag) {
            $old_src = $tag->getAttribute('src');
            $images = responsive_image($old_src);
            if ($images) {
                $tag->setAttribute('sizes', '100vw');
                $tag->setAttribute('src', $old_src);
                $tag->setAttribute('srcset', $images['small'] . ' 320w, ' . $images['medium'] . ' 640w, ' . $images['large'] . ' 1024w');
                $tag->setAttribute('loading', 'lazy');
            }
            $tag->setAttribute('src', $old_src);
            $tag->setAttribute('loading', 'lazy');
        }
        return $doc->saveHTML();
    }

    public function textToLinks($html)
    {
        // Check for http/ftp/email and convert to links
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

        if (preg_match($reg_exUrl, $html, $url)) {
            return preg_replace($reg_exUrl, '<a href="' . $url[0] . '"> ' . $url[0] . '</a> ', $html);
        }

        return $html;
    }

    public function category()
    {
        return $this->belongsTo(\Flowcms\Flowcms\Models\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
