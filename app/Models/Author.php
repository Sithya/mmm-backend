<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'page_id',
        'content',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
