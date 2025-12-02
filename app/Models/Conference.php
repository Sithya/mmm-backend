<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conference';
    
    protected $fillable = [
        'page_id',
        'name',
        'location',
        'start_date',
        'end_date',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
