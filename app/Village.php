<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'x',
        'y',
        'last_active',
    ];

    protected $dates = [
        'last_active',
    ];

    public function resources()
    {
        return $this->morphOne(Resource::class, 'resourcable');
    }

    public function buildings()
    {
        return $this->belongsToMany(Building::class);
    }
}
