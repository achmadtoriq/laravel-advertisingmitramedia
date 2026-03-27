<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'image',
        'title',
        'slug',
        'category',
        'location'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
