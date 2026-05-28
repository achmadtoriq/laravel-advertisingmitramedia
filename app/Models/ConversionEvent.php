<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionEvent extends Model
{
    protected $fillable = [
        'event_type',
        'source_url',
    ];
}
