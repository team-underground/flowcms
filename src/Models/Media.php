<?php

namespace Flowcms\Flowcms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'size',
        'type',
        'path',
        'caption',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getSizeAttribute($value)
    {
        return $this->bytesToHuman($value);
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->path);
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    public function bytesToHuman($bytes)
    {
        $units = ['bytes', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
