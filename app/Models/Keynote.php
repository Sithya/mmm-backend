<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Keynote extends Model
{
    protected $fillable = [
        'page_id',
        'name',
        'photo_url',
        'affiliation',
        'title',
        'bio',
        'content',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
