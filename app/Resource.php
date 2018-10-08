<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'food',
        'gold',
        'resourcable_id',
        'resourcable_type',
    ];

    public function resourcable()
    {
        return $this->morphTo();
    }
}
