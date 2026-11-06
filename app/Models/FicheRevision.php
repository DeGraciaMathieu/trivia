<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheRevision extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'avant' => 'array',
        'created_at' => 'datetime',
    ];
}
