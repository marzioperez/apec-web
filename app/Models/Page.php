<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model {

    use SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'is_home'
    ];

    protected $casts = [
        'content' => 'json',
        'is_home' => 'boolean'
    ];

    public  function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

}
