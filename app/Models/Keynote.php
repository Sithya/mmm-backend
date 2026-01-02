<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Keynote extends Model
{
    protected $fillable = [
        'page_id',
        'date',
        'time',
        'name',
        'photo_url',
        'title',
        'bio_html',
        'body_html',
    ];

    protected $appends = ['bio', 'content'];

    // Accessors to map frontend field names to database columns
    public function getBioAttribute()
    {
        return $this->attributes['bio_html'] ?? null;
    }

    public function getContentAttribute()
    {
        return $this->attributes['body_html'] ?? null;
    }

    // Mutators to map frontend field names to database columns
    public function setBioAttribute($value)
    {
        $this->attributes['bio_html'] = $value;
    }

    public function setContentAttribute($value)
    {
        $this->attributes['body_html'] = $value;
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
