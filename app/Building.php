<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'color',
    ];

    /**
     * @return void
     */
    public function upgrade(): void
    {
        $this->pivot->increment('level');
    }
}
