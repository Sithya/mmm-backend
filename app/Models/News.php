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
        'published_at',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
