<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conference';
    
    protected $fillable = [
        'page_id',
        'content',
        'json',
    ];

    protected $casts = [
        'json' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
