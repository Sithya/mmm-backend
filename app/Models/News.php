<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'content',
        'link_text',
        'link_url',
        'published_at',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
