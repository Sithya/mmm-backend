<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

    protected $fillable = [
        'registration_type',
        'first_name',
        'last_name',
        'email',
        'affiliation',
        'country',
        'dietary_restrictions',
        'agreed_to_terms',
    ];

    protected $casts = [
        'agreed_to_terms' => 'boolean',
    ];


}

