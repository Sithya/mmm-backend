<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organization';
    
    protected $fillable = [
        'page_id',
        'name',
        'category',
        'affiliation',
        'photo_url',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
