<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'json',
        'component',
    ];

    protected $casts = [
        'json' => 'array',
    ];

        public function calls():HasMany
    {
        return $this->hasMany(Call::class);
    }
    public function news():HasMany
    {
        return $this->hasMany(News::class);
    }
    public function conference()
    {
        return $this->hasOne(Conference::class);
    }
    public function authors():HasMany
    {
        return $this->hasMany(Author::class);
    }
    public function organizations():HasMany
    {
        return $this->hasMany(Organization::class);
    }
    public function keynotes():HasMany
    {
        return $this->hasMany(Keynote::class);
    }

}
