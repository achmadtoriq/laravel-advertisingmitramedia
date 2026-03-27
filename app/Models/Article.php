<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles_data';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'excerpt',
        'content',
        'views',
        'seo_title',
        'seo_description'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tag_data','article_id','tag_id');
    }
}
