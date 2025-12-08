<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportantDate extends Model
{
    protected $fillable = [
        'due_date',
        'description',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];
}

