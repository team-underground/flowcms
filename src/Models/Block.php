<?php

namespace Flowcms\Flowcms\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'page_id',
        'type',
        'value',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'page_id' => 'integer',
        'value' => 'array',
        'active' => 'boolean',
    ];

    public function page()
    {
        return $this->belongsTo(\Flowcms\Flowcms\Models\Page::class);
    }
}
